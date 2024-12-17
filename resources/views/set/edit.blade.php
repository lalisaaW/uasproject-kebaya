@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Edit Menu Settings for {{ $jenisUser->JENIS_USER }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('main') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('menu_settings.index') }}">Menu Settings</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Select Menus
        </div>
        <div class="card-body">
            <form action="{{ route('menu_settings.update', $jenisUser->ID_JENIS_USER) }}" method="POST">
                @csrf
                @method('PUT')
                @foreach($menus as $menu)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="menus[]" value="{{ $menu->MENU_ID }}" id="menu{{ $menu->MENU_ID }}"
                            {{ in_array($menu->MENU_ID, $selectedMenus) ? 'checked' : '' }}>
                        <label class="form-check-label" for="menu{{ $menu->MENU_ID }}">
                            {{ $menu->MENU_NAME }}
                        </label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-3">Update Menu Settings</button>
            </form>
        </div>
    </div>
</div>
@endsection

