<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LelangController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'level:admin,petugas'])->group(function () {
    Route::controller(BarangController::class)->group(function() {
        Route::get('barang', 'index')->name('barang.index');
        Route::get('barang/create', 'create')->name('barang.create');
        Route::post('barang', 'store')->name('barang.store');
        Route::get('barang/{barang}', 'show')->name('barang.show');
        Route::get('barang/{barang}/edit', 'edit')->name('barang.edit');
        Route::put('barang/{barang}', 'update')->name('barang.update');
        Route::delete('barang/{barang}', 'destroy')->name('barang.destroy');
    });
});

Route::middleware(['auth', 'level:petugas'])->group(function () {
Route::controller(LelangController::class)->group(function() {
    Route::get('lelang', 'index')->name('lelang.index');
    Route::get('lelang/create', 'create')->name('lelang.create');
    Route::post('lelang', 'store')->name('lelang.store');
    Route::get('lelang/{lelang}', 'show')->name('lelang.show');
    Route::get('lelang/{lelang}/edit', 'edit')->name('lelang.edit');
    Route::put('lelang/{lelang}', 'update')->name('lelang.update');
    Route::delete('lelang/{lelang}', 'destroy')->name('lelang.destroy');
    });
});
Route::get('login', [LoginController::class, 'view'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses')->middleware('guest');
Route::get('logout', [LoginController::class, 'logout'])->name('logout.petugas');

route::get('register', [RegisterController::class, 'view'])->name('register')->middleware(('guest'));
route::post('register', [RegisterController::class, 'store'])->name('register-store')->middleware(('guest'));


Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin')->middleware('auth');
Route::get('/dashboard/petugas', [DashboardController::class, 'petugas'])->name('dashboard.petugas')->middleware('auth');
Route::get('/dashboard/masyarakat', [DashboardController::class, 'masyarakat'])->name('dashboard.masyarakat')->middleware('auth');

// route register


route::view('403','error.403')->name('error.403');