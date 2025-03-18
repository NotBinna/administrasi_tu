<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes (Tanpa Middleware karena register dan login tidak perlu login dulu)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Semua Route yang Butuh Auth
Route::middleware(['auth'])->group(function () {
    // Redirect Dashboard Berdasarkan Role
    Route::get('/dashboard', function () {
        $role = auth()->user()->role_idRole;
        if ($role == 1) {
            return view('mahasiswa.dashboard');
        } else {
            return view('admin.dashboard');
        }
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware(['role:2,3'])->group(function () {
            Route::get('/users', [AdminController::class, 'index'])->name('users.index');
            Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
            Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');
        });
    });
});

require __DIR__ . '/auth.php';
