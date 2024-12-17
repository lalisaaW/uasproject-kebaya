@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create New Kebaya</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kebayas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="NAMA_KEBAYA" class="form-label">Kebaya Name</label>
            <input type="text" class="form-control" id="NAMA_KEBAYA" name="NAMA_KEBAYA" required maxlength="100" value="{{ old('NAMA_KEBAYA') }}">
        </div>
        <div class="mb-3">
            <label for="DESKRIPSI" class="form-label">Description</label>
            <textarea class="form-control" id="DESKRIPSI" name="DESKRIPSI" required>{{ old('DESKRIPSI') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="HARGA_SEWA" class="form-label">Rental Price (per day)</label>
            <input type="number" class="form-control" id="HARGA_SEWA" name="HARGA_SEWA" required value="{{ old('HARGA_SEWA') }}">
        </div>
        <div class="mb-3">
            <label for="UKURAN" class="form-label">Size</label>
            <input type="text" class="form-control" id="UKURAN" name="UKURAN" required maxlength="10" value="{{ old('UKURAN') }}">
        </div>
        <div class="mb-3">
            <label for="WARNA" class="form-label">Color</label>
            <input type="text" class="form-control" id="WARNA" name="WARNA" required maxlength="50" value="{{ old('WARNA') }}">
        </div>
        <div class="mb-3">
            <label for="FOTO_URL" class="form-label">Photo</label>
            <input type="file" class="form-control" id="FOTO_URL" name="FOTO_URL" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Create Kebaya</button>
        <a href="{{ route('kebayas.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
