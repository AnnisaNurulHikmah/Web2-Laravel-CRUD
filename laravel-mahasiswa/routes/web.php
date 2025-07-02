<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController; // letakkan semua use di atas

// // Route default (beranda)
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MahasiswaController::class, 'index']); // redirect root ke halaman mahasiswa

// Route resource mahasiswa
Route::resource('mahasiswa', MahasiswaController::class);

