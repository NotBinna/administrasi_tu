<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    Auth\RegisteredUserController,
    Auth\AuthenticatedSessionController,
    AdminController,
    SuratController,
    KaprodiController
};

// Halaman Utama
Route::get('/', function () {
    return view('welc');
});

// Auth Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware(['auth'])->group(function () {

    // Redirect dashboard sesuai role
    Route::get('/dashboard', function () {
        $role = auth()->user()->role_idRole;
        if ($role == 1) return view('mahasiswa.dashboard');
        else if ($role == 2) return view('kaprodi.dashboard');
        else return view('tu.dashboard');
    })->name('dashboard');

    // ========= Mahasiswa Routes (Role 1) =========
    Route::middleware(['role:1'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    });


    // ========= Kaprodi Routes (Role 2) =========
    Route::middleware(['role:2'])->prefix('kaprodi')->name('kaprodi.')->group(function () {
        Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
        Route::put('/surat/{id}/status', [KaprodiController::class, 'updateStatus'])->name('surat.updateStatus');
    });

    // ========= TU Routes (Role 3) =========
    Route::middleware(['role:3'])->prefix('tu')->name('tu.')->group(function () {
        Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
        Route::post('/surat/{surat}/upload', [SuratController::class, 'uploadSurat'])->name('surat.upload');
        Route::get('/users', [AdminController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');
    });

    // ========= Surat Umum (semua role login) =========
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat/store', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/surat/{surat}/download', [SuratController::class, 'downloadSurat'])->name('surat.download');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
