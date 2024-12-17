@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Rent Kebayas</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('rentals.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="TANGGAL_MULAI" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="TANGGAL_MULAI" name="TANGGAL_MULAI" required min="{{ date('Y-m-d') }}">
        </div>
        <div class="mb-3">
            <label for="TANGGAL_SELESAI" class="form-label">End Date</label>
            <input type="date" class="form-control" id="TANGGAL_SELESAI" name="TANGGAL_SELESAI" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
        </div>
        <h2>Kebayas in your cart:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Kebaya</th>
                    <th>Price per Day</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kebayas as $kebaya)
                    <tr>
                        <td>{{ $kebaya->NAMA_KEBAYA }}</td>
                        <td>Rp {{ number_format($kebaya->HARGA_SEWA, 0, ',', '.') }}</td>
                        <td>{{ $cart[$kebaya->ID_KEBAYA]['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit Rental Request</button>
    </form>
</div>
@endsection

