<?php

namespace App\Http\Controllers;

use App\Models\Kebaya;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class KebayaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['landingPage']);
    }

    public function index(Request $request)
    {
        $kebayas = Kebaya::where('DELETE_MARK', 'N')->get();
        return view('kebayas.index', compact('kebayas'));
    }

    public function create(Request $request)
    {
        if (!$request->user()->canUploadKebaya()) {
            abort(403, 'You are not authorized to upload kebayas.');
        }
        return view('kebayas.create');
    }

    public function store(Request $request)
    {
        if (!$request->user()->canUploadKebaya()) {
            abort(403, 'You are not authorized to upload kebayas.');
        }

        $validatedData = $request->validate([
            'NAMA_KEBAYA' => 'required|max:100',
            'DESKRIPSI' => 'required',
            'HARGA_SEWA' => 'required|numeric',
            'UKURAN' => 'required|max:10',
            'WARNA' => 'required|max:50',
            'FOTO_URL' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('FOTO_URL')) {
            $path = $request->file('FOTO_URL')->store('kebayas', 'public');
            $validatedData['FOTO_URL'] = $path;
        }

        $validatedData['ID_USER'] = Auth::id();
        $validatedData['CREATE_BY'] = Auth::user()->username;
        $validatedData['CREATE_DATE'] = now();
        $validatedData['DELETE_MARK'] = 'N';

        $kebaya = Kebaya::create($validatedData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Kebaya added successfully.',
                'kebaya' => $kebaya
            ]);
        }

        return redirect()->route('kebayas.index')->with('success', 'Kebaya added successfully.');
    }

    public function edit(Request $request, Kebaya $kebaya)
    {
        if (!$request->user()->canUploadKebaya() || $kebaya->ID_USER !== Auth::id()) {
            abort(403, 'You are not authorized to edit this kebaya.');
        }
        return view('kebayas.edit', compact('kebaya'));
    }

    public function update(Request $request, Kebaya $kebaya)
    {
        if (!$request->user()->canUploadKebaya() || $kebaya->ID_USER !== Auth::id()) {
            abort(403, 'You are not authorized to edit this kebaya.');
        }

        $validatedData = $request->validate([
            'NAMA_KEBAYA' => 'required|max:100',
            'DESKRIPSI' => 'required',
            'HARGA_SEWA' => 'required|numeric',
            'UKURAN' => 'required|max:10',
            'WARNA' => 'required|max:50',
            'FOTO_URL' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('FOTO_URL')) {
            $path = $request->file('FOTO_URL')->store('kebayas', 'public');
            $validatedData['FOTO_URL'] = $path;
        }

        $validatedData['UPDATE_BY'] = Auth::user()->username;
        $validatedData['UPDATE_DATE'] = now();

        $kebaya->update($validatedData);

        return redirect()->route('kebayas.index')->with('success', 'Kebaya updated successfully.');
    }

    public function destroy(Request $request, Kebaya $kebaya)
    {
        if (!$request->user()->canUploadKebaya() || $kebaya->ID_USER !== Auth::id()) {
            abort(403, 'You are not authorized to delete this kebaya.');
        }

        $kebaya->update([
            'DELETE_MARK' => 'Y',
            'UPDATE_BY' => Auth::user()->username,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('kebayas.index')->with('success', 'Kebaya deleted successfully.');
    }

    public function landingPage()
    {
        $kebayas = Kebaya::where('DELETE_MARK', 'N')->get();
        return view('kebayas.landing', compact('kebayas'));
    }

    public function rentFromLanding(Request $request, Kebaya $kebaya)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to rent a kebaya.');
        }

        if (!$request->user()->canRentKebaya()) {
            return redirect()->route('kebayas.landing')->with('error', 'You are not authorized to rent kebayas.');
        }

        $validatedData = $request->validate([
            'TANGGAL_MULAI' => 'required|date|after_or_equal:today',
            'TANGGAL_SELESAI' => 'required|date|after:TANGGAL_MULAI',
        ]);

        $days = (new \DateTime($validatedData['TANGGAL_MULAI']))->diff(new \DateTime($validatedData['TANGGAL_SELESAI']))->days + 1;
        $totalHarga = $kebaya->HARGA_SEWA * $days;

        $rental = new Rental([
            'ID_KEBAYA' => $kebaya->ID_KEBAYA,
            'ID_USER' => $request->user()->ID_USER,
            'TANGGAL_MULAI' => $validatedData['TANGGAL_MULAI'],
            'TANGGAL_SELESAI' => $validatedData['TANGGAL_SELESAI'],
            'TOTAL_HARGA' => $totalHarga,
            'STATUS' => 'pending',
            'CREATE_BY' => $request->user()->username,
            'CREATE_DATE' => now(),
            'DELETE_MARK' => 'N',
        ]);

        $rental->save();

        return redirect()->route('kebayas.landing')->with('success', 'Rental request submitted successfully.');
    }
}



