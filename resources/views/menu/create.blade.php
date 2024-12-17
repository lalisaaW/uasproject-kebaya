@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Menu Baru</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="MENU_NAME">Nama Menu</label>
            <input type="text" class="form-control @error('MENU_NAME') is-invalid @enderror" id="MENU_NAME" name="MENU_NAME" value="{{ old('MENU_NAME') }}" required>
            @error('MENU_NAME')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="MENU_LINK">Link Menu</label>
            <input type="text" class="form-control @error('MENU_LINK') is-invalid @enderror" id="MENU_LINK" name="MENU_LINK" value="{{ old('MENU_LINK') }}" required>
            @error('MENU_LINK')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="MENU_ICON">Icon Menu</label>
            <input type="text" class="form-control @error('MENU_ICON') is-invalid @enderror" id="MENU_ICON" name="MENU_ICON" value="{{ old('MENU_ICON') }}">
            @error('MENU_ICON')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection