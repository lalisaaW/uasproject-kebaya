@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Rental Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $rental->kebaya->NAMA_KEBAYA }}</h5>
            <p class="card-text"><strong>Start Date:</strong> {{ $rental->TANGGAL_MULAI->format('Y-m-d') }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $rental->TANGGAL_SELESAI->format('Y-m-d') }}</p>
            <p class="card-text"><strong>Total Price:</strong> Rp {{ number_format($rental->TOTAL_HARGA, 0, ',', '.') }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($rental->STATUS) }}</p>
            <p class="card-text"><strong>Created By:</strong> {{ $rental->CREATE_BY }}</p>
            <p class="card-text"><strong>Created Date:</strong> {{ $rental->CREATE_DATE }}</p>
            @if($rental->UPDATE_BY)
                <p class="card-text"><strong>Updated By:</strong> {{ $rental->UPDATE_BY }}</p>
                <p class="card-text"><strong>Updated Date:</strong> {{ $rental->UPDATE_DATE }}</p>
            @endif
        </div>
    </div>
    @if($rental->STATUS === 'pending')
        <div class="mt-3">
            <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-secondary">Edit Rental</a>
            <form action="{{ route('rentals.destroy', $rental) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this rental?')">Cancel Rental</button>
            </form>
        </div>
    @endif
</div>
@endsection

