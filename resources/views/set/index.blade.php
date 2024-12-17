@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Menu Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('main') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Menu Settings</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            User Types
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <table id="userTypesTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>User Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenisUsers as $jenisUser)
                    <tr>
                        <td>{{ $jenisUser->JENIS_USER }}</td>
                        <td>
                            <a href="{{ route('menu_settings.edit', $jenisUser->ID_JENIS_USER) }}" class="btn btn-primary btn-sm">Edit Menus</a>
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
        $('#userTypesTable').DataTable({
            responsive: true
        });
    });
</script>
@endsection

