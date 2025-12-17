@extends('layouts.auth')

@section('title', 'Login | Admin Panel Desa Digital')

@section('content')
    <div class="max-w-4xl w-full bg-white shadow-xl rounded-lg overflow-hidden md:flex">
        <!-- Image Side -->
        <div class="hidden md:block md:w-1/2">
            <img class="object-cover h-full w-full" src="{{ asset('img/village.jpg') }}" alt="Desa Digital">
        </div>

        <!-- Form Side -->
        <div class="w-full md:w-1/2 p-8 sm:p-12">
            <div class="text-center">
                <img class="mx-auto h-16 w-auto" src="{{ asset('img/logo-desa.png') }}" alt="Logo Desa Digital">
                <h1 class="mt-6 text-2xl font-bold text-gray-900">Admin Panel Login</h1>
                <p class="mt-2 text-sm text-gray-600">Silakan login untuk melanjutkan</p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('authenticate') }}" method="POST">
                @csrf

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Alamat Email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                               class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Alamat Email" value="{{ old('email') }}" autofocus>
                    </div>
                    <div>
                        <label for="password" class="sr-only">Kata Sandi</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Kata Sandi">
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-gray-900">Ingat saya</label>
                    </div>
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Lupa password?</a>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-indigo-400 group-hover:text-indigo-300"></i>
                        </span>
                        Login
                    </button>
                </div>

                <div class="text-sm text-center text-gray-600">
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Belum punya akun? Daftar!
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
