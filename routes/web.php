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
Auth::routes();

Route::get('/', [App\Http\Controllers\Dashboard::class, 'index'])->middleware('auth')->name('home');

Route::get('/dashboard', [App\Http\Controllers\Dashboard::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/data_karyawan', [App\Http\Controllers\DataKaryawan::class, 'index'])->middleware('auth')->name('data_karyawan');
Route::post('/tambahkaryawan', [App\Http\Controllers\DataKaryawan::class, 'TambahData'])->middleware('auth')->name('tambahkaryawan');
Route::post('/deletekaryawan', [App\Http\Controllers\DataKaryawan::class, 'delete'])->middleware('auth')->name('deletekaryawan');
Route::post('/editkaryawan', [App\Http\Controllers\DataKaryawan::class, 'edit'])->middleware('auth')->name('editkaryawan');

//presensi
Route::get('/presensi-bulan/{bulan}', [App\Http\Controllers\DataPresensi::class, 'index'])->middleware('auth')->name('presensi-bulan');

Route::post('/updatePresensi', [App\Http\Controllers\DataPresensi::class, 'updatePresensi'])->middleware('auth')->name('updatePresensi');
Route::post('/updateAbsensi', [App\Http\Controllers\DataPresensi::class, 'updateAbsensi'])->middleware('auth')->name('updateAbsensi');


//gaji
Route::get('/gaji-bulan/{bulan}', [App\Http\Controllers\DataGaji::class, 'index'])->middleware('auth')->name('gaji-bulan');
Route::post('/updateGaji', [App\Http\Controllers\DataGaji::class, 'updateGaji'])->middleware('auth')->name('updateGaji');
Route::get('/cetakSlipGaji/{data}', [App\Http\Controllers\DataGaji::class, 'cetak'])->middleware('auth')->name('cetakSlipGaji');
