<?php

use App\Http\Controllers\ak_kurikulum_bk_controller;
use App\Http\Controllers\ak_kurikulum_cpl_Controller;
use App\Http\Controllers\ak_kurikulum_cplr_Controller;
use App\Http\Controllers\ak_kurikulum_cpmk_controller;
use App\Http\Controllers\ak_kurikulum_pl_Controller;
use App\Http\Controllers\ak_kurikulum_sub_bk_controller;
use App\Http\Controllers\ak_matakuliah;
use App\Http\Controllers\ak_matakuliah_controller;
use App\Http\Controllers\matakuliah;
use App\Models\ak_kurikulum_bk;
use App\Models\ak_kurikulum_cpl;
use Illuminate\Support\Facades\DB;
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


// Sub BK
Route::resource('/subbk', ak_kurikulum_sub_bk_controller::class);
Route::get('/petaSubBK', [ak_kurikulum_sub_bk_controller::class, "listSubBK"])->name('list.subbk');
Route::get('/petaCPMKSHOW/{id}', [ak_kurikulum_sub_bk_controller::class, 'MapCPMKShow'])->name('MapCPMKShow');


// CPL

Route::resource('/cpl', ak_kurikulum_cpl_Controller::class);
Route::get('/cplEdit/{id}', [ak_kurikulum_cpl_Controller::class, 'edit'])->name('edit.cpl');
Route::post('/cplEdit/{id}', [ak_kurikulum_cpl_Controller::class, 'update'])->name('update.cpl');


// PL
Route::resource('/pl', ak_kurikulum_pl_Controller::class);
Route::get('/plEdit/{id}', [ak_kurikulum_pl_Controller::class, 'edit'])->name('edit.pl');
Route::post('/plEdit/{id}', [ak_kurikulum_pl_Controller::class, 'update'])->name('update.pl');


//CPLR
Route::resource('/cplr', ak_kurikulum_cplr_Controller::class);
Route::get('/cplrEdit/{id}', [ak_kurikulum_cplr_Controller::class, 'edit'])->name('edit.cplr');
Route::post('/cplrEdit/{id}', [ak_kurikulum_cplr_Controller::class, 'update'])->name('update.cplr');

// CPMK

// Route::get('/cpmkCreate{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkCreate'])->name('create.cpmk');
// Route::post('/cpmkCreate{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkStore'])->name('create.cpmk.post');


Route::get('/listcpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkList'])->name('list.cpmk');
Route::get('/petacpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkIndex'])->name('peta.cpmk');


Route::post('/cpmkStore', [ak_kurikulum_cpmk_controller::class, 'cpmkStore'])->name('store.cpmk');
// Route::get('/cpmkShow/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkShow'])->name('show.cpmk');
// Route::post('/cpmkShow/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkMapping'])->name('show.cpmk.post');
// Route::get('/cpmkEdit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkEditGet'])->name('edit.cpmk');
// Route::post('/cpmkEdit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkEditPOST'])->name('edit.cpmk.post');


// MATAKULIAH
Route::get('/matakuliah', [ak_matakuliah_controller::class, 'matakuliahIndex'])->name('home.matakuliah');
Route::get('/mkSubBK/{id}', [ak_matakuliah_controller::class, 'MapSBKShow'])->name('show.mkSBK');
Route::post('/mkSubBK/{id}', [ak_matakuliah_controller::class, 'mkSBKMapping'])->name('show.mkSBK.post');
Route::get('/subBKMK/{id}', [ak_matakuliah_controller::class, 'mkSubBKindex'])->name('show.subBKMK');
Route::get('/mkSubBKCPMK/{id}', [ak_matakuliah_controller::class, 'mapCPMKSBKshow'])->name('show.CPMKSBK');
Route::post('/mkSubBKCPMK/{id}', [ak_matakuliah_controller::class, 'mapCPMKSBKstore'])->name('show.CPMKSBK.post');

// ==========    NEWWWWWW       ============ //

Route::get('/mk', [matakuliah::class, 'indexMK'])->name('index.mk');
Route::get('/mk/create', [matakuliah::class, 'createMK'])->name('create.mk');
Route::post('/mkStore', [matakuliah::class, 'storeMK'])->name('store.mk');


/**
 * TEst route
 */

Route::get('/test', function () {
    $cpmk = DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
        ->where('id', '=', '7')
        ->first();
    $cpmk->ak_kurikulum_cpmk = unserialize($cpmk->ak_kurikulum_cpmk);
    // return dd($cpmk->ak_kurikulum_cpmk);
    $array = $cpmk->ak_kurikulum_cpmk;

    $data = DB::table('ak_kurikulum_cpmks')
        ->whereIn('id', $array)
        ->get();

    return dd($data);
});
