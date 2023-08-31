<?php

use App\Http\Controllers\ak_kurikulum_bk_controller;
use App\Http\Controllers\ak_kurikulum_cpl_Controller;
use App\Http\Controllers\ak_kurikulum_cplr_Controller;
use App\Http\Controllers\ak_kurikulum_cpmk_controller;
use App\Http\Controllers\ak_kurikulum_pl_Controller;
use App\Http\Controllers\ak_kurikulum_sub_bk_controller;
use App\Models\ak_kurikulum_bk;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');


Route::resource('/bk', ak_kurikulum_bk_controller::class);
Route::resource('/subbk', ak_kurikulum_sub_bk_controller::class);
Route::resource('/pl', ak_kurikulum_pl_Controller::class);
Route::resource('/cpl', ak_kurikulum_cpl_Controller::class);
Route::resource('/cplr', ak_kurikulum_cplr_Controller::class);
Route::resource('/cpmk', ak_kurikulum_cpmk_controller::class);

// Route::get('/profilelulusan', [ak_kurikulum_pl_Controller::class, 'index'])->name('index.profilelulusan');
// Route::get('/create', [ak_kurikulum_pl_Controller::class, 'create'])->name('create.profilelulusan');
// Route::post('/profilelulusan', [ak_kurikulum_pl_Controller::class, 'post'])->name('post.profilelulusan');
