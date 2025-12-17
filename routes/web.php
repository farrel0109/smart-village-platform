<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VillageController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\User\LetterRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==============================
// PUBLIC ROUTES (Landing Page)
// ==============================
Route::get('/', [LandingController::class, 'index'])->name('landing');

// ==============================
// GUEST ROUTES (Auth)
// ==============================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    
    // Rate limited auth routes
    Route::middleware('throttle:5,1')->group(function () {
        Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
        Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    });

    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
});

// ==============================
// AUTHENTICATED ROUTES
// ==============================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile management
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Notifications
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{notification}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

    // Two-Factor Authentication
    Route::get('/two-factor', [App\Http\Controllers\TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor/enable', [App\Http\Controllers\TwoFactorController::class, 'enable'])->name('two-factor.enable');
    Route::delete('/two-factor/disable', [App\Http\Controllers\TwoFactorController::class, 'disable'])->name('two-factor.disable');

    // User Dashboard (for regular users)
    Route::get('/dashboard', [App\Http\Controllers\UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/my-letters', [App\Http\Controllers\UserDashboardController::class, 'letters'])->name('user.letters');
    Route::get('/announcements', [App\Http\Controllers\UserDashboardController::class, 'announcements'])->name('user.announcements');
    Route::get('/announcements/{announcement}', [App\Http\Controllers\UserDashboardController::class, 'showAnnouncement'])->name('user.announcements.show');
});

// 2FA Verification (for login)
Route::get('/two-factor/verify', [App\Http\Controllers\TwoFactorController::class, 'showVerify'])->name('two-factor.verify');
Route::post('/two-factor/verify', [App\Http\Controllers\TwoFactorController::class, 'verify'])->name('two-factor.verify.post');

// ==============================
// ADMIN PANEL (superadmin & admin)
// ==============================
Route::middleware(['auth', 'role:superadmin,admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resident management
    Route::resource('residents', ResidentController::class)->except(['show']);
    
    // User management (approve/reject)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::patch('/users/{user}/reject', [UserController::class, 'reject'])->name('users.reject');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Letter requests management
    Route::get('/letters', [LetterController::class, 'index'])->name('letters.index');
    Route::get('/letters/{letter}', [LetterController::class, 'show'])->name('letters.show');
    Route::patch('/letters/{letter}/process', [LetterController::class, 'process'])->name('letters.process');
    Route::patch('/letters/{letter}/complete', [LetterController::class, 'complete'])->name('letters.complete');
    Route::patch('/letters/{letter}/reject', [LetterController::class, 'reject'])->name('letters.reject');
    Route::get('/letters/{letter}/download', [LetterController::class, 'download'])->name('letters.download');
    
    // Activity logs
    Route::get('/activity-logs', [App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
    
    // Family management
    Route::resource('families', App\Http\Controllers\Admin\FamilyController::class);
    Route::post('/families/{family}/add-member', [App\Http\Controllers\Admin\FamilyController::class, 'addMember'])->name('families.add-member');
    Route::delete('/families/{family}/members/{resident}', [App\Http\Controllers\Admin\FamilyController::class, 'removeMember'])->name('families.remove-member');
    
    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings/logo', [App\Http\Controllers\Admin\SettingsController::class, 'removeLogo'])->name('settings.remove-logo');
    
    // Reports
    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-residents', [App\Http\Controllers\Admin\ReportController::class, 'exportResidents'])->name('reports.export-residents');
    Route::get('/reports/export-families', [App\Http\Controllers\Admin\ReportController::class, 'exportFamilies'])->name('reports.export-families');
    Route::get('/reports/export-letters', [App\Http\Controllers\Admin\ReportController::class, 'exportLetters'])->name('reports.export-letters');
    
    // Letter Templates
    Route::resource('letter-templates', App\Http\Controllers\Admin\LetterTemplateController::class)->except(['show']);
    Route::get('/letter-templates/{letterTemplate}/preview', [App\Http\Controllers\Admin\LetterTemplateController::class, 'preview'])->name('letter-templates.preview');
    
    // Import
    Route::get('/import', [App\Http\Controllers\Admin\ImportController::class, 'index'])->name('import.index');
    Route::get('/import/template/{type}', [App\Http\Controllers\Admin\ImportController::class, 'downloadTemplate'])->name('import.template');
    Route::post('/import/preview', [App\Http\Controllers\Admin\ImportController::class, 'preview'])->name('import.preview');
    Route::post('/import/process', [App\Http\Controllers\Admin\ImportController::class, 'process'])->name('import.process');
    
    // Announcements
    Route::resource('announcements', App\Http\Controllers\Admin\AnnouncementController::class);
    Route::patch('/announcements/{announcement}/toggle', [App\Http\Controllers\Admin\AnnouncementController::class, 'togglePublish'])->name('announcements.toggle');
    
    // Backup
    Route::get('/backup', [App\Http\Controllers\Admin\BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup', [App\Http\Controllers\Admin\BackupController::class, 'create'])->name('backup.create');
    Route::get('/backup/{filename}/download', [App\Http\Controllers\Admin\BackupController::class, 'download'])->name('backup.download');
    Route::delete('/backup/{filename}', [App\Http\Controllers\Admin\BackupController::class, 'destroy'])->name('backup.destroy');
});

// ==============================
// SUPERADMIN ONLY
// ==============================
Route::middleware(['auth', 'role:superadmin'])->prefix('admin')->name('admin.')->group(function () {
    // Village management
    Route::resource('villages', VillageController::class)->except(['show']);
});

// ==============================
// USER PANEL
// ==============================
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.user.dashboard');
    })->name('dashboard');
    
    // Letter requests
    Route::get('/letters', [LetterRequestController::class, 'index'])->name('letters.index');
    Route::get('/letters/create', [LetterRequestController::class, 'create'])->name('letters.create');
    Route::post('/letters', [LetterRequestController::class, 'store'])->name('letters.store');
    Route::get('/letters/{letter}', [LetterRequestController::class, 'show'])->name('letters.show');
});
