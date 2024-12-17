@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Daftar Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('main') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar Menu</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Menu
            <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm float-end">Tambah Menu Baru</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <table id="menuTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Menu</th>
                        <th>Link</th>
                        <th>Icon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>{{ $menu->MENU_ID }}</td>
                        <td>{{ $menu->MENU_NAME }}</td>
                        <td>{{ $menu->MENU_LINK }}</td>
                        <td><i class="{{ $menu->MENU_ICON }}"></i> {{ $menu->MENU_ICON }}</td>
                        <td>
                            <a href="{{ route('menus.edit', $menu->MENU_ID) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->MENU_ID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#menuTable').DataTable({
            responsive: true
        });
    });
</script>
@endsection

