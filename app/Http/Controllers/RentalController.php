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

    public function index(Request $request)
    {
        $rentals = Rental::where('ID_USER', $request->user()->id)->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create(Request $request, Kebaya $kebaya)
    {
        if (!$request->user()->canRentKebaya()) {
            abort(403, 'You are not authorized to rent kebayas.');
        }
        return view('rentals.create', compact('kebaya'));
    }

    public function store(Request $request, Kebaya $kebaya)
    {
        if (!$request->user()->canRentKebaya()) {
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
            'ID_USER' => $request->user()->id,
            'TANGGAL_MULAI' => $validatedData['TANGGAL_MULAI'],
            'TANGGAL_SELESAI' => $validatedData['TANGGAL_SELESAI'],
            'TOTAL_HARGA' => $totalHarga,
            'STATUS' => 'pending',
            'CREATE_BY' => $request->user()->username,
            'CREATE_DATE' => now(),
            'DELETE_MARK' => 'N',
        ]);

        $rental->save();

        return redirect()->route('rentals.index')->with('success', 'Rental request submitted successfully.');
    }

    public function show(Request $request, Rental $rental)
    {
        if ($rental->ID_USER !== $request->user()->id) {
            abort(403, 'You are not authorized to view this rental.');
        }
        return view('rentals.show', compact('rental'));
    }

    public function cancel(Request $request, Rental $rental)
    {
        if ($rental->ID_USER !== $request->user()->id || $rental->STATUS !== 'pending') {
            abort(403, 'You are not authorized to cancel this rental.');
        }

        $rental->update([
            'STATUS' => 'cancelled',
            'UPDATE_BY' => $request->user()->username,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental cancelled successfully.');
    }
}

