@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Menu Management</h1>
    <div class="card mb-4">
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createMenuModal">
                Create New Menu
            </button>
            <div class="table-responsive">
                <table class="table table-bordered" id="menuTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Menu Name</th>
                            <th>Menu Link</th>
                            <th>Menu Icon</th>
                            <th>Parent Menu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->menu_name }}</td>
                            <td>{{ $menu->menu_link }}</td>
                            <td><i class="{{ $menu->menu_icon }}"></i></td>
                            <td>{{ $menu->parent ? $menu->parent->menu_name : '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-menu" data-menu-id="{{ $menu->menu_id }}">Edit</button>
                                <button class="btn btn-sm btn-danger delete-menu" data-menu-id="{{ $menu->menu_id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2>Role Menu Settings</h2>
        </div>
        <div class="card-body">
            @foreach($roles as $role)
            <h3>{{ $role->nama_role }}</h3>
            <form action="{{ route('setmenu.updateRoleMenuSettings', $role->role_id) }}" method="POST">
                @csrf
                @method('PUT')
                @foreach($menus as $menu)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="menus[]" value="{{ $menu->menu_id }}" id="menu{{ $menu->menu_id }}_role{{ $role->role_id }}"
                        {{ $role->menus->contains($menu) ? 'checked' : '' }}>
                    <label class="form-check-label" for="menu{{ $menu->menu_id }}_role{{ $role->role_id }}">
                        {{ $menu->menu_name }}
                    </label>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-2">Update {{ $role->nama_role }} Menu Settings</button>
            </form>
            <hr>
            @endforeach
        </div>
    </div>
</div>

<!-- Create Menu Modal -->
<div class="modal fade" id="createMenuModal" tabindex="-1" aria-labelledby="createMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMenuModalLabel">Create New Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('setmenu.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="menu_name" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="menu_name" name="menu_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="menu_link" class="form-label">Menu Link</label>
                        <input type="text" class="form-control" id="menu_link" name="menu_link" required>
                    </div>
                    <div class="mb-3">
                        <label for="menu_icon" class="form-label">Menu Icon</label>
                        <input type="text" class="form-control" id="menu_icon" name="menu_icon">
                    </div>
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Menu</label>
                        <select class="form-control" id="parent_id" name="parent_id">
                            <option value="">None (Main Menu)</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->menu_id }}">{{ $menu->menu_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Menu Modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editMenuForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_menu_name" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="edit_menu_name" name="menu_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_menu_link" class="form-label">Menu Link</label>
                        <input type="text" class="form-control" id="edit_menu_link" name="menu_link" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_menu_icon" class="form-label">Menu Icon</label>
                        <input type="text" class="form-control" id="edit_menu_icon" name="menu_icon">
                    </div>
                    <div class="mb-3">
                        <label for="edit_parent_id" class="form-label">Parent Menu</label>
                        <select class="form-control" id="edit_parent_id" name="parent_id">
                            <option value="">None (Main Menu)</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->menu_id }}">{{ $menu->menu_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this menu?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteMenuForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    $('#menuTable').DataTable();

$('.edit-menu').click(function() {
    var menuId = $(this).data('menu-id'); // Ambil menu_id dari tombol
    var url = "{{ route('setmenu.edit', ':id') }}".replace(':id', menuId); // Buat URL untuk edit

    // Set action form
    $('#editMenuForm').attr('action', "{{ route('setmenu.update', ':id') }}".replace(':id', menuId));

    // Fetch data menggunakan AJAX
    $.get(url, function(data) {
        $('#edit_menu_name').val(data.menu_name);
        $('#edit_menu_link').val(data.menu_link);
        $('#edit_menu_icon').val(data.menu_icon);
        $('#edit_parent_id').val(data.parent_id);
        $('#editMenuModal').modal('show');
    }).fail(function() {
        alert('Error: Cannot fetch menu data.');
    });
});


$('.delete-menu').click(function() {
    var menuId = $(this).data('menu-id'); // Ambil menu_id dari tombol
    var url = "{{ route('setmenu.destroy', ':id') }}".replace(':id', menuId); // Buat URL untuk delete

    // Set action form
    $('#deleteMenuForm').attr('action', url);
    $('#deleteMenuModal').modal('show');
});

});
</script>
@endsection

