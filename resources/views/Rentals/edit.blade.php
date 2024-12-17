@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Rental: {{ $rental->kebaya->NAMA_KEBAYA }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('rentals.update', $rental) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="TANGGAL_MULAI" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="TANGGAL_MULAI" name="TANGGAL_MULAI" value="{{ $rental->TANGGAL_MULAI->format('Y-m-d') }}" required>
        </div>
        <div class="mb-3">
            <label for="TANGGAL_SELESAI" class="form-label">End Date</label>
            <input type="date" class="form-control" id="TANGGAL_SELESAI" name="TANGGAL_SELESAI" value="{{ $rental->TANGGAL_SELESAI->format('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Rental</button>
    </form>
</div>
@endsection

