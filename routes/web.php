<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;

// 👤 ROUTE UNTUK GUEST (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});


// 🔒 ROUTE UNTUK USER YANG SUDAH LOGIN
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:admin,user')->group(function () {
        Route::get('/dashboard', function () {
            return view('pages.dashboard');
        })->name('dashboard');
    });

    // CRUD hanya untuk admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/resident', [ResidentController::class, 'index'])->name('pages.resident.index');
        Route::get('/resident/create', [ResidentController::class, 'create'])->name('resident.create');
        Route::get('/resident/{id}/edit', [ResidentController::class, 'edit'])->name('resident.edit');
        Route::post('/resident', [ResidentController::class, 'store'])->name('resident.store');
        Route::put('/resident/{id}/update', [ResidentController::class, 'update'])->name('resident.update');
        Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->name('resident.destroy');
    });
});