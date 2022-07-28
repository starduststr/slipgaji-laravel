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
Route::post('/editkaryawan', [App\Http\Controllers\DataKaryawan::class, 'edit'])->name('editkaryawan');

//presensi
Route::get('/presensi-bulan/{bulan}', [App\Http\Controllers\DataPresensi::class, 'index'])->name('presensi-bulan');

Route::post('/updatePresensi', [App\Http\Controllers\DataPresensi::class, 'updatePresensi'])->name('updatePresensi');
Route::post('/updateAbsensi', [App\Http\Controllers\DataPresensi::class, 'updateAbsensi'])->name('updateAbsensi');


//gaji
Route::get('/gaji-bulan/{bulan}', [App\Http\Controllers\DataGaji::class, 'index'])->name('gaji-bulan');
Route::post('/updateGaji', [App\Http\Controllers\DataGaji::class, 'updateGaji'])->name('updateGaji');
Route::get('/cetakSlipGaji/{data}', [App\Http\Controllers\DataGaji::class, 'cetak'])->name('cetakSlipGaji');
Auth::routes();
