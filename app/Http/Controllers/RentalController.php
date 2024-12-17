<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Kebaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class RentalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rentals = Rental::where('ID_USER', Auth::id())->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create(Kebaya $kebaya)
    {
        if (!Auth::user()->canRentKebaya()) {
            abort(403, 'You are not authorized to rent kebayas.');
        }
        return view('rentals.create', compact('kebaya'));
    }

    public function store(Request $request, Kebaya $kebaya)
    {
        if (!Auth::user()->canRentKebaya()) {
            abort(403, 'You are not authorized to rent kebayas.');
        }

        $validatedData = $request->validate([
            'TANGGAL_MULAI' => 'required|date|after_or_equal:today',
            'TANGGAL_SELESAI' => 'required|date|after:TANGGAL_MULAI',
        ]);

        $days = (new \DateTime($validatedData['TANGGAL_MULAI']))->diff(new \DateTime($validatedData['TANGGAL_SELESAI']))->days + 1;
        $totalHarga = $kebaya->HARGA_SEWA * $days;

        $rental = new Rental([
            'ID_KEBAYA' => $kebaya->ID_KEBAYA,
            'ID_USER' => Auth::id(),
            'TANGGAL_MULAI' => $validatedData['TANGGAL_MULAI'],
            'TANGGAL_SELESAI' => $validatedData['TANGGAL_SELESAI'],
            'TOTAL_HARGA' => $totalHarga,
            'STATUS' => 'pending',
            'CREATE_BY' => Auth::user()->username,
            'CREATE_DATE' => now(),
            'DELETE_MARK' => 'N',
        ]);

        $rental->save();

        return redirect()->route('rentals.index')->with('success', 'Rental request submitted successfully.');
    }

    public function show(Rental $rental)
    {
        if ($rental->ID_USER !== Auth::id()) {
            abort(403, 'You are not authorized to view this rental.');
        }
        return view('rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        if ($rental->ID_USER !== Auth::id() || $rental->STATUS !== 'pending') {
            abort(403, 'You are not authorized to edit this rental.');
        }
        return view('rentals.edit', compact('rental'));
    }

    public function update(Request $request, Rental $rental)
    {
        if ($rental->ID_USER !== Auth::id() || $rental->STATUS !== 'pending') {
            abort(403, 'You are not authorized to edit this rental.');
        }

        $validatedData = $request->validate([
            'TANGGAL_MULAI' => 'required|date|after_or_equal:today',
            'TANGGAL_SELESAI' => 'required|date|after:TANGGAL_MULAI',
        ]);

        $days = (new \DateTime($validatedData['TANGGAL_MULAI']))->diff(new \DateTime($validatedData['TANGGAL_SELESAI']))->days + 1;
        $totalHarga = $rental->kebaya->HARGA_SEWA * $days;

        $rental->update([
            'TANGGAL_MULAI' => $validatedData['TANGGAL_MULAI'],
            'TANGGAL_SELESAI' => $validatedData['TANGGAL_SELESAI'],
            'TOTAL_HARGA' => $totalHarga,
            'UPDATE_BY' => Auth::user()->username,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental updated successfully.');
    }

    public function destroy(Rental $rental)
    {
        if ($rental->ID_USER !== Auth::id() || $rental->STATUS !== 'pending') {
            abort(403, 'You are not authorized to cancel this rental.');
        }

        $rental->update([
            'STATUS' => 'cancelled',
            'UPDATE_BY' => Auth::user()->username,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental cancelled successfully.');
    }

    public function rent(Kebaya $kebaya)
    {
        if (!Auth::user()->canRentKebaya()) {
            abort(403, 'You are not authorized to rent kebayas.');
        }
        return view('rentals.rent', compact('kebaya'));
    }
}
