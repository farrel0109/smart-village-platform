<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Desa Digital</title>

    <!-- Font Awesome -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                    <h1 class="h4 text-gray-900 font-weight-bold">Selamat Datang Kembali!</h1>
                                    <p class="text-muted small">Silakan login untuk melanjutkan</p>
                                </div>

                                <form action="/login" method="POST" class="user">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group mb-3">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Alamat Email" required autofocus>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Kata Sandi" required>
                                    </div>
                                    <div class="form-group d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label small" for="rememberMe">Ingat saya</label>
                                        </div>
                                        <a href="#" class="small">Lupa password?</a>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                                    </button>
                                    
                                    <hr class="my-4">

                                    <div class="text-center">
                                        <a class="small" href="/register">Belum punya akun? Daftar!</a>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript Libraries -->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    {{-- Notifikasi SweetAlert2 --}}
@if(session('status_modal'))
    @php
        $status = session('status_modal');
        $statusConfig = [
            'submitted' => [
            'type' => 'standard',
            'icon' => 'info',
            'title' => 'Sedang Diproses',
            'message' => 'Akun anda masih menunggu persetujuan admin.'
            ],
            'rejected' => [
                'type' => 'standard',
                'icon' => 'error',
                'title' => 'Ditolak',
                'message' => 'Akun anda telah ditolak oleh admin.'
            ],
            'invalid' => [
                'type' => 'standard',
                'icon' => 'warning',
                'title' => 'Login Gagal',
                'message' => 'Terjadi kesalahan saat login. Periksa kembali email dan kata sandi Anda.'
            ],
        ];
        $config = $statusConfig[$status] ?? [
            'type' => 'standard',
            'icon' => 'question',
            'title' => 'Pemberitahuan',
            'message' => 'Status tidak diketahui.'
        ];
    @endphp

    @if($config['type'] === 'custom')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "{{ $config['title'] }}",
                    html: `{!! $config['html'] !!}`,
                    confirmButtonText: 'Tutup'
                });
            });
        </script>
    @else
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: "{{ $config['icon'] }}",
                    title: "{{ $config['title'] }}",
                    text: "{{ $config['message'] }}",
                    confirmButtonText: 'Tutup'
                });
            });
        </script>
    @endif
@endif


</body>

</html>
