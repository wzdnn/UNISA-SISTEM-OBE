<?php

use App\Http\Controllers\ak_kurikulum_bk_controller;
use App\Http\Controllers\ak_kurikulum_cpl_Controller;
use App\Http\Controllers\ak_kurikulum_cplr_Controller;
use App\Http\Controllers\ak_kurikulum_cpmk_controller;
use App\Http\Controllers\ak_kurikulum_pl_Controller;
use App\Http\Controllers\ak_kurikulum_sub_bk_controller;
use App\Http\Controllers\ak_matakuliah_controller;
use App\Http\Controllers\aspekController;
use App\Http\Controllers\basisIlmuController;
use App\Http\Controllers\bidangIlmuController;
use App\Http\Controllers\organisasiMKController;
use App\Http\Controllers\sumberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\visimisiController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/postLogin', [UserController::class, 'postLogin'])->name('postLogin');
});

Route::get('/tampilan', function () {
    return view('pages.matkul');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'test']);
    Route::get('/logout', [UserController::class, 'logout']);


    Route::get('/', [visimisiController::class, 'vmIndex'])->name('welcome');

    Route::get('/VisiMisi', [visimisiController::class, 'vmIndex'])->name('index.VM');


    // Aspek
    Route::get('/aspek', [aspekController::class, 'indexAspek'])->name('index.aspek');
    Route::middleware(['role:admin'])->group(function () {
        Route::post('/storeAspek', [aspekController::class, 'storeAspek'])->name('store.aspek');
        Route::get('/aspek/{id}', [aspekController::class, 'delete'])->name('delete.aspek');
    });


    //Sumber
    Route::get('/sumber', [sumberController::class, 'indexSumber'])->name('index.sumber');
    Route::middleware(['role:admin'])->group(function () {
        Route::post('/storeSumber', [sumberController::class, 'storeSumber'])->name('store.sumber');
        Route::get('/sumber/{id}', [sumberController::class, 'delete'])->name('delete.sumber');
    });


    // Basis Ilmu
    Route::get('/basisIlmu', [basisIlmuController::class, 'indexBasisIlmu'])->name('index.basil');
    Route::middleware(['role:admin'])->group(function () {
        Route::post('/postBasisIlmu', [basisIlmuController::class, 'storeBasisIlmu'])->name('store.basil');
        Route::get('/basisIlmu/{id}', [basisIlmuController::class, 'delete'])->name('delete.basil');
    });


    // Bidang Ilmu
    Route::get('/bidangIlmu', [bidangIlmuController::class, 'indexBidangIlmu'])->name('index.bidil');
    Route::middleware(['role:admin'])->group(function () {
        Route::post('/postBidangIlmu', [bidangIlmuController::class, 'storeBidangIlmu'])->name('store.bidil');
        Route::get('/bidangIlmu/{id}', [bidangIlmuController::class, 'delete'])->name('delete.bidil');
    });



    // BK
    Route::resource('/bk', ak_kurikulum_bk_controller::class);
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/bkEdit/{id}', [ak_kurikulum_bk_Controller::class, 'edit'])->name('edit.bk');
        Route::post('/bkEdit/{id}', [ak_kurikulum_bk_Controller::class, 'update'])->name('update.bk');
        Route::get('/bk/{id}/delete', [ak_kurikulum_bk_Controller::class, 'delete'])->name('delete.bk');
        Route::get('/showBKSBK', [ak_kurikulum_bk_controller::class, 'showBKSBK'])->name('bksbk.show');
    });




    // Sub BK
    Route::resource('/subbk', ak_kurikulum_sub_bk_controller::class);

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/subbk/{id}/delete', [ak_kurikulum_sub_bk_Controller::class, 'delete'])->name('delete.subbk');
        Route::get('/petaSubBK', [ak_kurikulum_sub_bk_controller::class, "listSubBK"])->name('list.subbk');
        Route::get('/petaCPMKSHOW/{id}', [ak_kurikulum_sub_bk_controller::class, 'MapCPMKShow'])->name('MapCPMKShow');
        Route::post('/petaCPMKSHOW/{id}', [ak_kurikulum_sub_bk_controller::class, 'MappingCPMK'])->name('MapCPMKShow.post');

        Route::get('/subbkEdit/{id}', [ak_kurikulum_sub_bk_controller::class, 'edit'])->name('edit.subbk');
        Route::post('/subbkEdit/{id}', [ak_kurikulum_sub_bk_controller::class, 'update'])->name('update.subbk');
    });




    // CPL

    Route::resource('/cpl', ak_kurikulum_cpl_Controller::class);
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/cpl/{id}/delete', [ak_kurikulum_cpl_Controller::class, 'delete'])->name('cpl.delete');
        Route::get('/cplEdit/{id}', [ak_kurikulum_cpl_Controller::class, 'edit'])->name('edit.cpl');
        Route::post('/cplEdit/{id}', [ak_kurikulum_cpl_Controller::class, 'update'])->name('update.cpl');
    });


    // PL
    Route::resource('/pl', ak_kurikulum_pl_Controller::class);

    Route::middleware(['role:admin'])->group(function () {

        Route::get('/plEdit/{id}', [ak_kurikulum_pl_Controller::class, 'edit'])->name('edit.pl');
        Route::post('/plEdit/{id}', [ak_kurikulum_pl_Controller::class, 'update'])->name('update.pl');

        Route::get('/pl/{id}/delete', [ak_kurikulum_pl_Controller::class, 'delete'])->name('delete.pl');
    });


    //CPLR
    Route::resource('/cplr', ak_kurikulum_cplr_Controller::class);
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/cplrEdit/{id}', [ak_kurikulum_cplr_Controller::class, 'edit'])->name('edit.cplr');
        Route::post('/cplrEdit/{id}', [ak_kurikulum_cplr_Controller::class, 'update'])->name('update.cplr');
        Route::get('/cplr/{id}/delete', [ak_kurikulum_cplr_Controller::class, 'delete'])->name('delete.cplr');
    });


    // CPMK

    // Route::get('/cpmkCreate{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkCreate'])->name('create.cpmk');
    // Route::post('/cpmkCreate{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkStore'])->name('create.cpmk.post');


    Route::get('/listcpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkList'])->name('list.cpmk');
    Route::get('/petacpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkIndex'])->name('peta.cpmk');
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/cpmk/{id}/delete', [ak_kurikulum_cpmk_controller::class, 'delete'])->name('delete.cpmk');
    });


    Route::post('/cpmkStore', [ak_kurikulum_cpmk_controller::class, 'cpmkStore'])->name('store.cpmk');
    // Route::get('/cpmkShow/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkShow'])->name('show.cpmk');
    // Route::post('/cpmkShow/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkMapping'])->name('show.cpmk.post');
    // Route::get('/cpmkEdit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkEditGet'])->name('edit.cpmk');
    // Route::post('/cpmkEdit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkEditPOST'])->name('edit.cpmk.post');


    // MATAKULIAH

    Route::get('/matakuliah', [ak_matakuliah_controller::class, 'mkIndex'])->name('index.mk');



    Route::middleware(['role:admin'])->group(function () {
        Route::get('/DetailMK/{id}', [ak_matakuliah_controller::class, 'subbkDetail'])->name('detail.mk'); // detail MK
        Route::get('/matakuliah/Create', [ak_matakuliah_controller::class, 'mkCreate'])->name('create.mk');
        Route::post('/matakuliah/Store', [ak_matakuliah_controller::class, 'mkStore'])->name('store.mk');


        Route::post('/DetailMK/{id}', [ak_matakuliah_controller::class, 'postsubbkDetail'])->name('post.detail.mk'); // detail MK
        Route::get('/DetailMK/{id}/subbk', [ak_matakuliah_controller::class, 'kelolaSubBK'])->name('mk.subbk'); // kelola subbk
        Route::post('/DetailMK/{id}/subbk', [ak_matakuliah_controller::class, 'postkelolaSubBK']);

        Route::get('/DetailMK/{id}/cpmk/{sub}', [ak_matakuliah_controller::class, 'subbkCPMK'])->name('subbk.cpmk'); // kelola subbk cpmk
        Route::post('/DetailMK/{id}/cpmk/{sub}', [ak_matakuliah_controller::class, 'postsubbkSKS']);
        Route::get('/DetailMK/{id}/cpmk/{sub}/kelolaCpmk', [ak_matakuliah_controller::class, 'kelolacpmk'])->name('subbk.cpmk.kelola'); // kelola subbk cpmk
        Route::post('/DetailMK/{id}/cpmk/{sub}/kelolaCpmk', [ak_matakuliah_controller::class, 'postkelolacpmk']);
    });

    // Organisasi Matakuliah

    Route::get('/organisasiMatakuliah', [organisasiMKController::class, 'orgMKShow'])->name('organisasi.mk');
    Route::post('/organisasiMatakuliah', [organisasiMKController::class, 'kelolaMKWPOST']);

    Route::post('/temaStore', [organisasiMKController::class, 'temaSTORE'])->name('store.tema');

    Route::get('/reset/{id}', [organisasiMKController::class, 'semesterOrigin'])->name('reset.mk');
});






// Route::get('/petaCPMKSHOW/{id}', [ak_matakuliah_controller::class, 'MapCPMKShow'])->name('CPMKshow.mk');
// Route::post('/petaCPMKSHOW/{id}', [ak_matakuliah_controller::class, 'mappingCPMK'])->name('CPMKpost.mk');
// Route::get('/matakuliah/edit/{id}', [ak_matakuliah_controller::class, 'subbkEdit'])->name('edit.mk');
// Route::post('/matakuliah/edit/store/{id}', [ak_matakuliah_controller::class, 'subbkEditStore'])->name('update.mk');



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
