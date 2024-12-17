@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Edit User</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('users.update', $user->ID_USER) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="wa" class="form-label">WhatsApp</label>
                    <input type="text" class="form-control @error('wa') is-invalid @enderror" id="wa" name="wa" value="{{ old('wa', $user->wa) }}" required>
                    @error('wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ID_JENIS_USER" class="form-label">User Type</label>
                    <select class="form-control @error('ID_JENIS_USER') is-invalid @enderror" id="ID_JENIS_USER" name="ID_JENIS_USER" required>
                        @foreach($jenisUsers as $jenisUser)
                            <option value="{{ $jenisUser->ID_JENIS_USER }}" {{ $user->ID_JENIS_USER == $jenisUser->ID_JENIS_USER ? 'selected' : '' }}>
                                {{ $jenisUser->JENIS_USER }}
                            </option>
                        @endforeach
                    </select>
                    @error('ID_JENIS_USER')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>
@endsection

