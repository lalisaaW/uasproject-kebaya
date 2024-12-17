@extends('layouts.main')

@section('content')
<div class="container">
    <h1>{{ $kebaya->NAMA_KEBAYA }}</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            @if($kebaya->FOTO_URL)
                <img src="{{ asset('storage/'.$kebaya->FOTO_URL) }}" alt="{{ $kebaya->NAMA_KEBAYA }}" class="img-fluid">
            @endif
        </div>
        <div class="col-md-6">
            <p><strong>Description:</strong> {{ $kebaya->DESKRIPSI }}</p>
            <p><strong>Size:</strong> {{ $kebaya->UKURAN }}</p>
            <p><strong>Color:</strong> {{ $kebaya->WARNA }}</p>
            <p><strong>Rental Price:</strong> Rp {{ number_format($kebaya->HARGA_SEWA, 0, ',', '.') }} / day</p>
            @if(Auth::user()->canRentKebaya() && Auth::id() != $kebaya->ID_USER)
                <form action="{{ route('cart.add', $kebaya) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
                <a href="{{ route('kebayas.rent', $kebaya) }}" class="btn btn-secondary">Rent Now</a>
            @endif
            @if(Auth::user()->canUploadKebaya() && $kebaya->ID_USER == Auth::id())
                <a href="{{ route('kebayas.edit', $kebaya) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('kebayas.destroy', $kebaya) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection

