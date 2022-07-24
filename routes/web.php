<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Dashboard::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard');
Route::get('/data_karyawan', [App\Http\Controllers\DataKaryawan::class, 'index'])->name('data_karyawan');
Route::post('/tambahkaryawan', [App\Http\Controllers\DataKaryawan::class, 'TambahData'])->name('tambahkaryawan');
Route::post('/deletekaryawan', [App\Http\Controllers\DataKaryawan::class, 'delete'])->name('deletekaryawan');

Auth::routes();


