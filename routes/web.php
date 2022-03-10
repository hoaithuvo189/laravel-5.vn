<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;

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
    return view("welcome");
});

Route::group(["prefix" => "admin"], function() {
    Route::group(["prefix" => "theloai"], function() {
        // admin/theloai/danhsach
        Route::get("danhsach", [TheLoaiController::class, "getDanhSach"]);
        Route::get("them", [TheLoaiController::class, "getThem"]);
        Route::post("them", [TheLoaiController::class, "postThem"]);

        Route::get("sua/{id}", [TheLoaiController::class, "getSua"]);
        Route::post("sua/{id}", [TheLoaiController::class, "postSua"]);

        Route::get("xoa/{id}", [TheLoaiController::class, "getXoa"]);
    });

    Route::group(["prefix" => "loaitin"], function() {
        // admin/loaitin/danhsach
        Route::get("danhsach", [LoaiTinController::class, "getDanhSach"]);
        Route::get("them", [LoaiTinController::class, "getThem"]);
        Route::post("them", [LoaiTinController::class, "postThem"]);

        Route::get("sua/{id}", [LoaiTinController::class, "getSua"]);
        Route::post("sua/{id}", [LoaiTinController::class, "postSua"]);

        Route::get("xoa/{id}", [LoaiTinController::class, "getXoa"]);
    });
});
