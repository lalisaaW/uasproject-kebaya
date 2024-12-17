@extends('layouts.konten')

@section('page-content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Pengaturan Menu</h2>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Jenis User</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisUsers as $jenisUser)
                        <tr>
                            <td>{{ $jenisUser->JENIS_USER }}</td>
                            <td class="text-center">
                                <a href="{{ route('menu_settings.edit', $jenisUser->ID_JENIS_USER) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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
@endsection
