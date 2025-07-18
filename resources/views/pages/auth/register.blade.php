<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register | Desa Digital</title>

    <!-- Font Awesome -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow border-0">
                    <div class="row g-0">
                        <!-- Image Side -->
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('/img/village.jpg'); background-size: cover;"></div>

                        <!-- Form Side -->
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 font-weight-bold">Daftar Akun Baru</h1>
                                    <p class="text-muted small">Isi data untuk membuat akun</p>
                                </div>

                                <form action="/register" method="POST" class="user">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group mb-3">
                                        <input type="text" name="name" class="form-control form-control-user" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Alamat Email" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Kata Sandi" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <i class="fas fa-user-plus mr-2"></i> Daftar
                                    </button>
                                    <!-- Modal HTML -->
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <a class="small" href="/login">Sudah punya akun? Login!</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div>

        </div>
    </div>

    <!-- JS Libraries -->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

</body>

</html>