<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\UnitKerjaController;
Route::get('/unit-kerja', [UnitKerjaController::class, 'index']);
