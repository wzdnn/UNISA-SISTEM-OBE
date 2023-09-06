<?php

use App\Http\Controllers\ak_kurikulum_bk_controller;
use App\Http\Controllers\ak_kurikulum_cpl_Controller;
use App\Http\Controllers\ak_kurikulum_cplr_Controller;
use App\Http\Controllers\ak_kurikulum_cpmk_controller;
use App\Http\Controllers\ak_kurikulum_pl_Controller;
use App\Http\Controllers\ak_kurikulum_sub_bk_controller;
use App\Http\Controllers\ak_matakuliah;
use App\Http\Controllers\ak_matakuliah_controller;
use App\Models\ak_kurikulum_bk;
use App\Models\ak_kurikulum_cpl;
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


Route::get('/matakuliah', [ak_matakuliah_controller::class, 'matakuliahIndex'])->name('home.matakuliah');

// CPMK
Route::get('/cpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkIndex'])->name('cpmk');
Route::get('/listcpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkList'])->name('list.cpmk');
Route::get('/cpmkMapStore', [ak_kurikulum_cpmk_controller::class, 'cpmkMapStore'])->name('mapStore.cpmk');
Route::post('/cpmkStore', [ak_kurikulum_cpmk_controller::class, 'cpmkStore'])->name('store.cpmk');
Route::post('/cpmkMapping', [ak_kurikulum_cpmk_controller::class, 'cpmkMapping'])->name('mapping.cpmk');
Route::get('/cpmkShow/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkShow'])->name('show.cpmk');
Route::post('/cpmkShow/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkMapping'])->name('show.cpmk.post');


// Route::get('/cpmk', [ak_kurikulum_cpl_Controller::class, 'indexCpmk'])->name('Cpmk');
// Route::get('/profilelulusan', [ak_kurikulum_pl_Controller::class, 'index'])->name('index.profilelulusan');
// Route::get('/create', [ak_kurikulum_pl_Controller::class, 'create'])->name('create.profilelulusan');
// Route::post('/profilelulusan', [ak_kurikulum_pl_Controller::class, 'post'])->name('post.profilelulusan');
