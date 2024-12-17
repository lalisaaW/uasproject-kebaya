@extends('layouts.main')

@section('page-content')
<div class="container">
    <h1>Menus</h1>
    <a href="{{ route('menus.create') }}" class="btn btn-primary">Create Menu</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
 
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Link</th>
                <th>Icon</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->menu_id }}</td>
                    <td>{{ $menu->menu_name }}</td>
                    <td>{{ $menu->menu_link }}</td>
                    <td>{{ $menu->menu_icon }}</td>
                    <td>
                        <a href="{{ route('menus.edit', $menu) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- {{ $menus->links() }}  --}}
@endsection
<style>
    .card {
        border-radius: 8px;
    }

    .table thead th {
        background-color: #343a40;
        color: #fff;
    }

    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 0.9rem;
    }

    .fas.fa-edit {
        margin-right: 5px;
    }
</style>