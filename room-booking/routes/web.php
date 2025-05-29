<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Ruang\CreateRuang;
use App\Livewire\Ruang\EditRuang;
use App\Livewire\Ruang\ListRuang;
use App\Livewire\Pegawai\ListPegawai;
use App\Livewire\Pegawai\CreatePegawai;
use App\Livewire\Pegawai\EditPegawai;
use App\Livewire\UnitKerja\ListUnitKerja;
use App\Livewire\UnitKerja\CreateUnitKerja;
use App\Livewire\UnitKerja\EditUnitKerja;
use App\Livewire\Peminjaman\ListPeminjaman;
use App\Livewire\Peminjaman\CreatePeminjaman;
use App\Livewire\Counter;
use App\Livewire\Peminjaman\EditPeminjaman;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});
Route::get('/counter', Counter::class); 
//Ruang
Route::get('ruang', ListRuang::class)->name('ruang.index');
Route::get('ruang/create', CreateRuang::class)->name('ruang.create');
Route::get('/ruang/edit/{ruang}', EditRuang::class)->name('ruang.edit'); 
//Pegawai
Route::get('pegawai', ListPegawai::class)->name('pegawai.index');
Route::get('pegawai/create', CreatePegawai::class)->name('pegawai.create');
Route::get('/pegawai/{pegawai_id}/edit', EditPegawai::class)->name('pegawai.edit');
//Unit kerja
Route::get('unitkerja', ListUnitKerja::class)->name('unitkerja.index');
Route::get('unitkerja/create', CreateUnitKerja::class)->name('unitkerja.create');
Route::get('/unitkerja/edit/{unit_id}', EditUnitKerja::class)->name('unitkerja.edit');
//Peminjaman
Route::get('peminjaman', ListPeminjaman::class)->name('peminjaman.index');
Route::get('peminjaman/create', CreatePeminjaman::class)->name('peminjaman.create');
// Route::get('/peminjaman/edit/{unit_id}', EditPeminjaman::class)->name('peminjaman.edit');
Route::get('/peminjaman/{peminjaman_id}/edit', EditPeminjaman::class)->name('peminjaman.edit');



/**
 * dengan parameter ruang di endpoint nya
 */
// Route::get('ruang/edit/{ruang}', EditRuang::class)->name('ruang.edit');
require __DIR__.'/auth.php';
