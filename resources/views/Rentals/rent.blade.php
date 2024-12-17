@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Rent Kebaya: {{ $kebaya->NAMA_KEBAYA }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('kebayas.store', $kebaya) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="TANGGAL_MULAI" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="TANGGAL_MULAI" name="TANGGAL_MULAI" required min="{{ date('Y-m-d') }}">
        </div>
        <div class="mb-3">
            <label for="TANGGAL_SELESAI" class="form-label">End Date</label>
            <input type="date" class="form-control" id="TANGGAL_SELESAI" name="TANGGAL_SELESAI" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit Rental Request</button>
    </form>
</div>
@endsection
