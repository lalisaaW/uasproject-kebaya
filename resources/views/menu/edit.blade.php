@extends('layouts.main')

@section('page-content')
<div class="container">
    <h1>Edit Menu</h1>

    <form action="{{ route('menus.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="menu_name">Menu Name</label>
            <input type="text" name="menu_name" class="form-control" value="{{ $menu->menu_name}}" required>
        </div>
        <div class="form-group">
            <label for="menu_link">Menu link</label>
            <input type="text" name="menu_link" class="form-control" value="{{ $menu->menu_link }}" required>
        </div>
        <div class="form-group">
            <label for="menu_icon">Menu icon</label>
            <input type="text" name="menu_icon" class="form-control" value="{{ $menu->menu_icon }}">
        </div>
        {{-- <div class="form-group">
            <label for="PARENT_ID">Parent ID</label>
            <input type="text" name="PARENT_ID" class="form-control" value="{{ $menu->PARENT_ID }}">
        </div> --}}
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
