<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UserDashboardController;

// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VillageController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\LetterTemplateController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\BackupController;

// User Controllers
use App\Http\Controllers\User\LetterRequestController;

// API Controllers
use App\Http\Controllers\Api\RegionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ============================================================================
// PUBLIC ROUTES
// ============================================================================

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Region API (for cascading dropdowns)
Route::prefix('api/regions')->name('api.regions.')->group(function () {
    Route::get('/provinces', [RegionController::class, 'provinces'])->name('provinces');
    Route::get('/regencies/{provinceId}', [RegionController::class, 'regencies'])->name('regencies');
    Route::get('/districts/{regencyId}', [RegionController::class, 'districts'])->name('districts');
    Route::get('/villages/{districtId}', [RegionController::class, 'villages'])->name('villages');
});

// ============================================================================
// GUEST ROUTES (Authentication)
// ============================================================================

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');

    // Rate limited actions
    Route::middleware('throttle:5,1')->group(function () {
        Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
        Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    });
});

// ============================================================================
// AUTHENTICATED ROUTES (Common)
// ============================================================================

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('update-password');
    });

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::get('/{notification}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
    });

    // Two-Factor Authentication Settings
    Route::prefix('two-factor')->name('two-factor.')->group(function () {
        Route::get('/', [TwoFactorController::class, 'index'])->name('index');
        Route::post('/enable', [TwoFactorController::class, 'enable'])->name('enable');
        Route::delete('/disable', [TwoFactorController::class, 'disable'])->name('disable');
    });
});

// ============================================================================
// 2FA VERIFICATION
// ============================================================================

Route::middleware(['web'])->group(function () {
    Route::get('/two-factor/verify', [TwoFactorController::class, 'showVerify'])->name('two-factor.verify');
    Route::post('/two-factor/verify', [TwoFactorController::class, 'verify'])->name('two-factor.verify.post');
});

// ============================================================================
// USER PANEL (Role: User)
// ============================================================================

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
    // Announcements
    Route::get('/announcements', [UserDashboardController::class, 'announcements'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [UserDashboardController::class, 'showAnnouncement'])->name('announcements.show');

    // Letter Requests (using LetterRequestController)
    Route::prefix('letters')->name('letters.')->group(function () {
        Route::get('/', [LetterRequestController::class, 'index'])->name('index');
        Route::get('/create', [LetterRequestController::class, 'create'])->name('create');
        Route::post('/', [LetterRequestController::class, 'store'])->name('store');
        Route::get('/{letter}', [LetterRequestController::class, 'show'])->name('show');
    });
});

// ============================================================================
// ADMIN PANEL (Role: Superadmin & Admin)
// ============================================================================

Route::middleware(['auth', 'role:superadmin,admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Core Data Management
    Route::resource('residents', ResidentController::class)->except(['show']);
    Route::resource('families', FamilyController::class);
    
    // Family Members
    Route::post('/families/{family}/add-member', [FamilyController::class, 'addMember'])->name('families.add-member');
    Route::delete('/families/{family}/members/{resident}', [FamilyController::class, 'removeMember'])->name('families.remove-member');

    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::patch('/{user}/approve', [UserController::class, 'approve'])->name('approve');
        Route::patch('/{user}/reject', [UserController::class, 'reject'])->name('reject');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Letter Management
    Route::prefix('letters')->name('letters.')->group(function () {
        Route::get('/', [LetterController::class, 'index'])->name('index');
        Route::get('/{letter}', [LetterController::class, 'show'])->name('show');
        Route::get('/{letter}/download', [LetterController::class, 'download'])->name('download');
        
        // Actions
        Route::patch('/{letter}/process', [LetterController::class, 'process'])->name('process');
        Route::patch('/{letter}/complete', [LetterController::class, 'complete'])->name('complete');
        Route::patch('/{letter}/reject', [LetterController::class, 'reject'])->name('reject');
    });

    // Letter Templates
    Route::resource('letter-templates', LetterTemplateController::class)->except(['show']);
    Route::get('/letter-templates/{letterTemplate}/preview', [LetterTemplateController::class, 'preview'])->name('letter-templates.preview');

    // Announcements
    Route::resource('announcements', AnnouncementController::class);
    Route::patch('/announcements/{announcement}/toggle', [AnnouncementController::class, 'togglePublish'])->name('announcements.toggle');

    // Reports & Exports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/export-residents', [ReportController::class, 'exportResidents'])->name('export-residents');
        Route::get('/export-families', [ReportController::class, 'exportFamilies'])->name('export-families');
        Route::get('/export-letters', [ReportController::class, 'exportLetters'])->name('export-letters');
    });

    // System Tools
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    
    // Import Data
    Route::prefix('import')->name('import.')->group(function () {
        Route::get('/', [ImportController::class, 'index'])->name('index');
        Route::get('/template/{type}', [ImportController::class, 'downloadTemplate'])->name('template');
        Route::post('/preview', [ImportController::class, 'preview'])->name('preview');
        Route::post('/process', [ImportController::class, 'process'])->name('process');
    });

    // Backup System
    Route::prefix('backup')->name('backup.')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('index');
        Route::post('/', [BackupController::class, 'create'])->name('create');
        Route::get('/{filename}/download', [BackupController::class, 'download'])->name('download');
        Route::delete('/{filename}', [BackupController::class, 'destroy'])->name('destroy');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::put('/', [SettingsController::class, 'update'])->name('update');
        Route::delete('/logo', [SettingsController::class, 'removeLogo'])->name('remove-logo');
    });
});

// ============================================================================
// SUPERADMIN ONLY ROUTES
// ============================================================================

Route::middleware(['auth', 'role:superadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('villages', VillageController::class)->except(['show']);
});
