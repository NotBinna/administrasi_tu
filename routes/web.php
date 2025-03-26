<?php
use App\Http\Controllers\{ProfileController, Auth\RegisteredUserController, Auth\AuthenticatedSessionController, AdminController, SuratController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaprodiController;




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

    // Kaprodi Routes
    Route::middleware(['role:2'])->group(function () {
        Route::get('/kaprodi/surat', [SuratController::class, 'index'])->name('kaprodi.surat.index');
        Route::put('/kaprodi/surat/{id}/status', [KaprodiController::class, 'updateStatus'])->name('kaprodi.surat.updateStatus');
    });

    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat/store', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('surat.show');
    Route::post('/surat/{surat}/upload', [SuratController::class, 'uploadSurat'])->name('surat.upload');
    Route::get('/surat/{surat}/download', [SuratController::class, 'downloadSurat'])->name('surat.download');

    // Resource paling bawah biar gak nabrak
    Route::resource('surat', SuratController::class)->except(['create', 'store']);


    // Kaprodi Controller
    Route::put('/kaprodi/surat/{id}/status', [KaprodiController::class, 'updateStatus'])->name('kaprodi.surat.updateStatus');
});

// Surat Routes

require __DIR__ . '/auth.php';
