<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Mahasiswa\DashboardMahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FadhilTugasController;
use App\Http\Controllers\FadhilKategoriController;
use App\Http\Controllers\FadhilMataKuliahController;
use App\Http\Controllers\FadhilPengumpulanTugasController;
use App\Http\Middleware\RoleAccess;

Route::get('/', [FadhilPengumpulanTugasController::class, 'landing'])->name('landing');

// 🔓 Daftar tugas mahasiswa bisa diakses tanpa login
Route::get('mahasiswa/tugas', [FadhilPengumpulanTugasController::class, 'index'])->name('mahasiswa.tugas.index');
Route::get('mahasiswa/tugas/{id}', [FadhilPengumpulanTugasController::class, 'show'])->name('mahasiswa.tugas.show');

// 🔐 ADMIN (hanya admin)
Route::middleware(['auth', RoleAccess::class . ':admin'])->group(function () {
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('tugas', FadhilTugasController::class);
        Route::resource('kategori', FadhilKategoriController::class);
        Route::resource('mata-kuliah', FadhilMataKuliahController::class);
        Route::get('tugas/{id}/pengumpulan', [FadhilTugasController::class, 'pengumpulan'])->name('tugas.pengumpulan');
    });
});

// 🔐 MAHASISWA (hanya mahasiswa)
Route::middleware(['auth', RoleAccess::class . ':mahasiswa'])->group(function () {
    Route::get('/mahasiswa', [DashboardMahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('mahasiswa/riwayat', [\App\Http\Controllers\Mahasiswa\RiwayatController::class, 'index'])->name('mahasiswa.riwayat.index');
    Route::post('mahasiswa/tugas/{id}/kumpul', [FadhilPengumpulanTugasController::class, 'store'])->name('mahasiswa.tugas.kumpul');
});

// 🔐 Login & Register
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
