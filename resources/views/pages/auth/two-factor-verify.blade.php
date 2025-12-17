{{-- /resources/views/pages/auth/two-factor-verify.blade.php --}}

@extends('layouts.auth')

@section('title', 'Verifikasi 2FA')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shield-alt text-indigo-600 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Verifikasi 2FA</h1>
            <p class="text-gray-600 mt-2">Masukkan kode 6 digit Anda</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('two-factor.verify.post') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Kode Verifikasi</label>
                <input type="text" name="code" id="code" 
                       class="w-full px-4 py-3 text-center text-2xl tracking-widest border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                       maxlength="6" pattern="[0-9]{6}" required autofocus
                       placeholder="000000">
                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                Verifikasi
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('logout') }}" class="text-sm text-gray-600 hover:text-gray-800"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Kembali ke halaman login
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </div>
    </div>
</div>

@endsection
