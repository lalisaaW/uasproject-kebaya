@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Edit Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('main') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Daftar Menu</a></li>
        <li class="breadcrumb-item active">Edit Menu</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Edit Menu
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('menus.update', $menu->MENU_ID) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="MENU_NAME" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="MENU_NAME" name="MENU_NAME" value="{{ old('MENU_NAME', $menu->MENU_NAME) }}" required>
                </div>
                <div class="mb-3">
                    <label for="MENU_LINK" class="form-label">Link Menu</label>
                    <input type="text" class="form-control" id="MENU_LINK" name="MENU_LINK" value="{{ old('MENU_LINK', $menu->MENU_LINK) }}" required>
                </div>
                <div class="mb-3">
                    <label for="MENU_ICON" class="form-label">Icon Menu</label>
                    <input type="text" class="form-control" id="MENU_ICON" name="MENU_ICON" value="{{ old('MENU_ICON', $menu->MENU_ICON) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update Menu</button>
                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // You can add any JavaScript for the edit form here
</script>
@endsection

