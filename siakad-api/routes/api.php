<?php

use App\Models\User;
use App\Models\Dosen;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\DosenController;
use App\Http\Controllers\API\SiswaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//API route for login user
Route::post('/login-siswa', [AuthController::class, 'loginSiswa']);
Route::post('/login-dosen', [AuthController::class, 'loginDosen']);
Route::post('/login-admin', [AuthController::class, 'loginAdmin']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    #SISWA
    Route::get('/profile-siswa', [SiswaController::class, 'profileSiswa']);
    Route::get('/data-semua-siswa', [SiswaController::class, 'semuaDataSiswa']);
    Route::post('/registrasi-ulang', [SiswaController::class, 'registrasiUlang']);
    Route::get('/status-registrasi-ulang', [SiswaController::class, 'statusRegistrasiUlang']);
    Route::get('/kartu-studi-siswa', [SiswaController::class, 'kartuStudiSiswa']);
    Route::get('/status-registrasi-matakuliah', [SiswaController::class, 'statusRegistrasiMatakuliah']);
    Route::get('/jadwal-kuliah', [SiswaController::class, 'jadwalKuliah']);
    Route::get('/registrasi-matakuliah', [SiswaController::class, 'registrasiMatakuliah']);



    #DOSEN
    Route::get('/profile-dosen', [DosenController::class, 'profileDosen']);

    #ADMIN
    Route::post('/cari-siswa', [AdminController::class, 'cariSiswa']);
    Route::post('/hapus-siswa', [AdminController::class, 'hapusSiswa']);
    Route::post('/cari-dosen', [AdminController::class, 'cariDosen']);
    Route::post('/hapus-dosen', [AdminController::class, 'hapusDosen']);
    Route::get('/ambil-riwayat', [AdminController::class, 'ambilRiwayat']);
    Route::post('/tambah-siswa', [AuthController::class, 'tambahSiswa']);
    Route::post('/tambah-dosen', [AuthController::class, 'tambahDosen']);
    Route::post('/update-siswa',[AdminController::class, 'updateSiswa']);
    Route::post('/update-dosen',[AdminController::class, 'updateDosen']);
    Route::post('/tampil-TA',[AdminController::class, 'tampilTA']);
    Route::post('/update-TA',[AdminController::class, 'updateTA']);

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});
