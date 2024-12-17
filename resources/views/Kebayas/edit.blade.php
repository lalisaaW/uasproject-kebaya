@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Kebaya</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('kebayas.update', $kebaya) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="NAMA_KEBAYA" class="form-label">Kebaya Name</label>
            <input type="text" class="form-control" id="NAMA_KEBAYA" name="NAMA_KEBAYA" value="{{ $kebaya->NAMA_KEBAYA }}" required>
        </div>
        <div class="mb-3">
            <label for="DESKRIPSI" class="form-label">Description</label>
            <textarea class="form-control" id="DESKRIPSI" name="DESKRIPSI" required>{{ $kebaya->DESKRIPSI }}</textarea>
        </div>
        <div class="mb-3">
            <label for="HARGA_SEWA" class="form-label">Rental Price (per day)</label>
            <input type="number" class="form-control" id="HARGA_SEWA" name="HARGA_SEWA" value="{{ $kebaya->HARGA_SEWA }}" required>
        </div>
        <div class="mb-3">
            <label for="UKURAN" class="form-label">Size</label>
            <input type="text" class="form-control" id="UKURAN" name="UKURAN" value="{{ $kebaya->UKURAN }}" required>
        </div>
        <div class="mb-3">
            <label for="WARNA" class="form-label">Color</label>
            <input type="text" class="form-control" id="WARNA" name="WARNA" value="{{ $kebaya->WARNA }}" required>
        </div>
        <div class="mb-3">
            <label for="FOTO_URL" class="form-label">Photo</label>
            <input type="file" class="form-control" id="FOTO_URL" name="FOTO_URL">
            @if($kebaya->FOTO_URL)
                <img src="{{ asset('storage/'.$kebaya->FOTO_URL) }}" alt="{{ $kebaya->NAMA_KEBAYA }}" class="mt-2" style="max-width: 200px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Kebaya</button>
    </form>
</div>
@endsection

