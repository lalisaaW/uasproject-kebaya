@extends('layouts.main')

@section('page-content')
<div class="container">
    <h1>Create menu</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="menu_name">menu name:</label>
            <input type="text" name="menu_name" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="menu_link">menu link:</label>
            <input type="text" name="menu_link" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="menu_icon">menu icon:</label>
            <input type="text" name="menu_icon" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="create_by">Created By:</label>
            <input type="text" name="create_by" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>
        
        <button type="submit" class="btn btn-primary">Create menu</button>
    </form>
</div>
@endsection
