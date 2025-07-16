<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ScanController;

Route::get('/', function () {
    return view('landing.home');
})->name('home');

Route::get('/tentang', function () {
    return view('landing.tentang');
})->name('about');

Route::get('/kontak', function () {
    return view('landing.contact');
})->name('contact');

Route::get('/fitur', function () {
    return view('landing.fitur');
})->name('features');

Route::get('/cara-kerja', function () {
    return view('landing.cara_kerja');
})->name('how-it-works');

// Authentication routes
Route::get('/login-user', [AuthController::class, 'showLoginForm'])->name('login-user');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Alias untuk Laravel default
Route::post('/login-user', [AuthController::class, 'login'])->name('login-user-prosess');
Route::post('/logout-user', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('jadwal', JadwalController::class);
    
    // QR Code routes
    Route::get('/jadwal/{jadwal}/qrcode', [QrCodeController::class, 'generate'])->name('qrcode.generate');
    Route::post('/jadwal/{jadwal}/qrcode', [QrCodeController::class, 'store'])->name('qrcode.store');
    Route::get('/qrcode/{qrcode}', [QrCodeController::class, 'show'])->name('qrcode.show');
    Route::get('/qrcode/{qrcode}/svg', [QrCodeController::class, 'generateQrSvg'])->name('qrcode.svg');
    Route::get('/jadwal/{jadwal}/qrcodes', [QrCodeController::class, 'index'])->name('qrcode.index');
    Route::delete('/qrcode/{qrcode}', [QrCodeController::class, 'destroy'])->name('qrcode.destroy');

    // Menu Absensi
    Route::get('/absensi', [\App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/{jadwal}', [\App\Http\Controllers\AbsensiController::class, 'show'])->name('absensi.show');
    Route::post('/absensi/{jadwal}', [\App\Http\Controllers\AbsensiController::class, 'store'])->name('absensi.store');

    // Menu Mata Kuliah
    Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/matakuliah/{matakuliah}', [MatakuliahController::class, 'show'])->name('matakuliah.show');

    // Menu Scan Absen untuk Mahasiswa
    Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan/process', [ScanController::class, 'scan'])->name('scan.process');
    Route::get('/mahasiswa/jadwal', [ScanController::class, 'jadwal'])->name('mahasiswa.jadwal');
    Route::get('/mahasiswa/absensi', [ScanController::class, 'riwayat'])->name('mahasiswa.absensi');
    
    // Menu Absen Anggota untuk Mahasiswa
    Route::get('/mahasiswa/absen-anggota', [ScanController::class, 'absenAnggota'])->name('mahasiswa.absen-anggota');
    Route::get('/mahasiswa/absen-anggota/{jadwal}', [ScanController::class, 'absenAnggotaJadwal'])->name('mahasiswa.absen-anggota.jadwal');
    Route::post('/mahasiswa/absen-anggota/{jadwal}/store', [ScanController::class, 'storeAbsenAnggota'])->name('mahasiswa.absen-anggota.store');
});