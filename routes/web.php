<?php

use Illuminate\Support\Facades\Route;
use App\Barang;
use Illuminate\Support\Facades\DB;

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

Route::get("/", function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole("admin")) {
            return redirect()->route('admin.dashboard');
        } else {
            return back();
        }
    } else {
        $barangs = DB::table('barangs')->limit(8)->get();
        return view("home", compact("barangs"));
    }
});
Auth::routes();
// Route::get("/home", "HomeController@index");



Route::prefix("/admin")->name("admin.")->middleware(['role:admin', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@adminDashboard')->name("dashboard");
    Route::get('/profil', 'HomeController@myProfil')->name("profil");
    Route::post('/gantiPassword/update', 'HomeController@gantiPassword')->name("gantiPassword.update");
    Route::get('/gantiPassword', 'HomeController@gantiPasswordPage')->name("gantiPassword");

    Route::post('/profil/update', 'HomeController@myProfilUpdate')->name("myProfil.update");

    Route::resource("manajemen_user", "ManajemenUserController");
    Route::post("manajemen_user/gantiPassword", "ManajemenUserController@gantiPassword")->name("gantiPasswordModal");
    Route::resource("manajemen_barang", "BarangController");
    Route::resource("penjualan_barang", "PenjualanBarangController");
    // Route::resource("peminjaman_barang", "PeminjamanController");
    // Route::put("peminjaman_barang/pengembalian/{id}", "PeminjamanController@pengembalian")->name("pengembalian");
    // Route::get("peminjaman_barang/checkStokBrg/{id}", "PeminjamanController@checkJumlahBarang");
    // Route::resource("pengembalian_barang", "PengembalianController");
    // Route::get("pengembalian_barang/checkJumlahPeminjaman/{id}", "PengembalianController@checkJumlahPengembalianBarang");
    // Route::get("pengembalian_barang/ajaxData/{id}", "PengembalianController@ajaxDataPengembalian")->name("pengembalian_barang.getData");
});
