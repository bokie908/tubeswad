<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPerusahaanController;

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

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/register', [UserController::class, "register"])->name("auth.register");
Route::get('/login', [UserController::class, "login"])->name("auth.login");
Route::get("/logout", [UserController::class, "logout"])->name("logout");
Route::get("/user/profile", [UserController::class, "profile"])->name("user.profil");
Route::get("/loker", [UserController::class, "loker"])->name("loker");
Route::post("/process/register", [UserController::class, "processRegister"])->name("process.register");
Route::post("/process/login", [UserController::class, "processLogin"])->name("process.login");
Route::post("/process/profile/edit", [UserController::class, "editProfile"])->name("process.edit_profile");
Route::post("/process/perusahaan/profile/edit", [UserPerusahaanController::class, "editProfile"])->name("process.perusahaan.edit_profile");
Route::get("/home2", [UserController::class, "home2"])->name("home2");
Route::get("/listPengajuan", [UserController::class, "listPengajuan"])->name("listPengajuan");

Route::get('/login/perusahaan', [UserPerusahaanController::class, "login"])->name("auth.perusahaan.login");
Route::get('/register/perusahaan', [UserPerusahaanController::class, "register"])->name("auth.perusahaan.register");
Route::post("/process/register/perusahaan", [UserPerusahaanController::class, "processRegister"])->name("process.perusahaan.register");
Route::post("/process/login/perusahaan", [UserPerusahaanController::class, "processLogin"])->name("process.perusahaan.login");
Route::get("/perusahaan/form/loker/tambah", [UserPerusahaanController::class, "formTambahLoker"])->name("perusahaan.loker.tambah");
Route::post("/perusahaan/loker/tambah", [UserPerusahaanController::class, "postLowonganPekerjaan"])->name("process.perusahaan.loker.tambah");
Route::get("/perusahaan/profil", [UserPerusahaanController::class, "profil"])->name("perusahaan.profil");
Route::get("/loker/detail/{id}", [LokerController::class, "detailLoker"])->name("loker.detail");
Route::get("/loker/acc/{id}", [LokerController::class, "accLoker"])->name("loker.acc");
Route::get("/loker/dcc/{id}", [LokerController::class, "dccLoker"])->name("loker.dcc");
Route::get("/loker/stop/{id}", [LokerController::class, "stopLoker"])->name("loker.stop");

Route::post("/loker/next", [LokerController::class, "nextLoker"])->name("loker.next");

Route::get("/loker/{id}", [LokerController::class, "lihatLoker"])->name("loker.lihat");
Route::get("/perusahaan/{id}", [UserPerusahaanController::class, "lihatPerusahaan"])->name("perusahaan.lihat");
Route::get("/ajuposisi/{user_id}/{loker_id}/{status_request}", [UserController::class, "ajukanPosisi"])->name("ajukanposisi");

Route::get('/login/admin', [AdminController::class, "login"])->name("auth.admin.login");
Route::post('/process/login/admin', [AdminController::class, "processLogin"])->name("process.admin.login");
Route::get('/admin/userperusahaan/verifikasi', [AdminController::class, "verifikasiPerusahaan"])->name("admin.verifikasi_user_perusahaan");
Route::get("/admin/userperusahaan/terima/{id}", [AdminController::class, "terimaUserPerusahaan"])->name("admin.terima.perusahaan");
Route::get("/admin/userperusahaan/tolak/{id}", [AdminController::class, "tolakUserPerusahaan"])->name("admin.tolak.perusahaan");

Route::get('/search', [LokerController::class, 'search'])->name('search');
