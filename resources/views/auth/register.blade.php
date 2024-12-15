<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                            </div>

                            <h4>Login & Register</h4>

                            <form action="{{ route('register') }}" method="POST" class="mt-4">
                                @csrf
                                <h4>Register Form</h4>
                            
                                <!-- Dropdown untuk memilih role -->
                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="role_id" required>
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="2">Penjual</option>
                                        <option value="3">Pembeli</option>
                                    </select>
                                    @error('role_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            
                                <!-- Input nama -->
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="nama" placeholder="Name" autocomplete="off" required>
                                    @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            
                                <!-- Input email -->
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" autocomplete="off" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            
                                <!-- Input nomor HP -->
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="no_hp" placeholder="Phone Number" pattern="[0-9]{10,15}" autocomplete="off" required>
                                    @error('no_hp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            
                                <!-- Input password -->
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" autocomplete="off" required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            
                                <!-- Input konfirmasi password -->
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm Password" autocomplete="off" required>
                                </div>
                            
                                <!-- Tombol register -->
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-secondary btn-lg font-weight-medium auth-form-btn">
                                        REGISTER
                                    </button>
                                </div>
                            </form>
                            

                            <div class="text-center mt-4 font-weight-light">
                                Sudah punya akun? <a href="/login" class="text-primary">login</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
</body>

</html>