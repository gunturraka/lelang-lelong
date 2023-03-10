<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;
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

// Controller HistoryLelang
Route::controller(HistoryController::class)->group(function() {
    //ROUTE HISTORY LELANG
    Route::get('/menawar/{lelang}', 'create')->name('lelangin.create')->middleware('auth','level:masyarakat');
    Route::get('cetak-history', 'cetakhistory')->name('cetak.history')->middleware('auth','level:petugas,admin');
    Route::get('/data-penawaran', 'index')->name('datapenawar.index')->middleware('auth','level:petugas,admin');
    Route::post('/menawar/{lelang}', 'store')->name('lelangin.store')->middleware('auth','level:masyarakat');
    Route::delete('/data-penawaran/{lelang}', 'destroy')->name('lelangin.destroy')->middleware('auth','level:petugas');
    Route::put('/lelangpetugas/{id}/pemenang', 'setPemenang')->name('lelangpetugas.setpemenang');
        });

Route::controller(UserController::class)->group(function() {
    Route::get('user', 'index')->name('user.index');
    Route::get('user/create', 'create')->name('user.create');
    Route::post('user', 'store')->name('user.store');
    Route::get('user/{user}', 'show')->name('user.show');
    Route::get('user/{user}/edit', 'edit')->name('user.edit');
    Route::put('user/{user}', 'update')->name('user.update');
    Route::delete('user/{user}', 'destroy')->name('user.destroy');
});

route::view('403','error.403')->name('error.403');