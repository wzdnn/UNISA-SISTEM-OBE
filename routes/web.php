<?php

use App\Http\Controllers\ak_kurikulum_bk_controller;
use App\Http\Controllers\ak_kurikulum_cpl_Controller;
use App\Http\Controllers\ak_kurikulum_cplr_Controller;
use App\Http\Controllers\ak_kurikulum_cpmk_controller;
use App\Http\Controllers\ak_kurikulum_pl_Controller;
use App\Http\Controllers\ak_kurikulum_sub_bk_controller;
use App\Http\Controllers\ak_matakuliah;
use App\Http\Controllers\ak_matakuliah_controller;
use App\Http\Controllers\aspekController;
use App\Http\Controllers\basisIlmuController;
use App\Http\Controllers\bidangIlmuController;
use App\Http\Controllers\matakuliah;
use App\Http\Controllers\metodePenilaianController;
use App\Http\Controllers\organisasiMkController;
use App\Http\Controllers\sumberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\visimisiController;
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

    Route::get('/visi-misi', [visimisiController::class, 'vmIndex'])->name('index.VM');

    Route::get('/get-rekomendasi-sks', [ak_matakuliah_controller::class, 'getRekomendasiSK'])->name('get.rekomendasiSKS');


    // Aspek
    Route::get('/aspek', [aspekController::class, 'indexAspek'])->name('index.aspek');
    Route::post('/store-aspek', [aspekController::class, 'storeAspek'])->name('store.aspek');
    Route::get('/aspek/{id}', [aspekController::class, 'delete'])->name('delete.aspek');

    //Sumber
    Route::get('/sumber', [sumberController::class, 'indexSumber'])->name('index.sumber');
    Route::post('/store-sumber', [sumberController::class, 'storeSumber'])->name('store.sumber');
    Route::get('/sumber/{id}', [sumberController::class, 'delete'])->name('delete.sumber');

    // Basis Ilmu
    Route::get('/basis-ilmu', [basisIlmuController::class, 'indexBasisIlmu'])->name('index.basil');
    Route::post('/post-basis-ilmu', [basisIlmuController::class, 'storeBasisIlmu'])->name('store.basil');
    Route::get('/basis-ilmu/{id}', [basisIlmuController::class, 'delete'])->name('delete.basil');

    // Bidang Ilmu
    Route::get('/bidang-ilmu', [bidangIlmuController::class, 'indexBidangIlmu'])->name('index.bidil');
    Route::post('/post-bidang-ilmu', [bidangIlmuController::class, 'storeBidangIlmu'])->name('store.bidil');
    Route::get('/bidang-ilmu/{id}', [bidangIlmuController::class, 'delete'])->name('delete.bidil');


    // BK
    Route::resource('/bk', ak_kurikulum_bk_controller::class);
    Route::get('/bk-edit/{id}', [ak_kurikulum_bk_Controller::class, 'edit'])->name('edit.bk');
    Route::post('/bk-edit/{id}', [ak_kurikulum_bk_Controller::class, 'update'])->name('update.bk');
    Route::get('/bk/{id}/delete', [ak_kurikulum_bk_Controller::class, 'delete'])->name('delete.bk');
    Route::get('/show-bk-sbk', [ak_kurikulum_bk_controller::class, 'showBKSBK'])->name('bksbk.show');




    // Sub BK
    Route::resource('/sub-bk', ak_kurikulum_sub_bk_controller::class);
    Route::get('/peta-sub-bk', [ak_kurikulum_sub_bk_controller::class, "listSubBK"])->name('list.subbk');

    Route::get('/sub-bk/{id}/delete', [ak_kurikulum_sub_bk_Controller::class, 'delete'])->name('delete.subbk');

    Route::get('/peta-cpmk-show/{id}', [ak_kurikulum_sub_bk_controller::class, 'MapCPMKShow'])->name('MapCPMKShow');
    Route::post('/peta-cpmk-show/{id}', [ak_kurikulum_sub_bk_controller::class, 'MappingCPMK'])->name('MapCPMKShow.post');

    Route::get('/sub-bk-edit/{id}', [ak_kurikulum_sub_bk_controller::class, 'edit'])->name('edit.subbk');
    Route::post('/sub-bk-edit/{id}', [ak_kurikulum_sub_bk_controller::class, 'update'])->name('update.subbk');


    // CPL

    Route::resource('/cpl', ak_kurikulum_cpl_Controller::class);
    Route::middleware(['role:user,admin'])->group(function () {
        Route::get('/cpl/{id}/delete', [ak_kurikulum_cpl_Controller::class, 'delete'])->name('cpl.delete');
        Route::get('/cpl-edit/{id}', [ak_kurikulum_cpl_Controller::class, 'edit'])->name('edit.cpl');
        Route::post('/cpl-edit/{id}', [ak_kurikulum_cpl_Controller::class, 'update'])->name('update.cpl');
    });


    // PL
    Route::resource('/pl', ak_kurikulum_pl_Controller::class);
    Route::get('/pl-edit/{id}', [ak_kurikulum_pl_Controller::class, 'edit'])->name('edit.pl');
    Route::post('/pl-edit/{id}', [ak_kurikulum_pl_Controller::class, 'update'])->name('update.pl');

    Route::get('/pl/{id}/delete', [ak_kurikulum_pl_Controller::class, 'delete'])->name('delete.pl');


    //CPLR
    Route::resource('/cplr', ak_kurikulum_cplr_Controller::class);
    Route::get('/cplr-edit/{id}', [ak_kurikulum_cplr_Controller::class, 'edit'])->name('edit.cplr');
    Route::post('/cplr-edit/{id}', [ak_kurikulum_cplr_Controller::class, 'update'])->name('update.cplr');
    Route::get('/cplr/{id}/delete', [ak_kurikulum_cplr_Controller::class, 'delete'])->name('delete.cplr');

    // CPMK

    // Route::get('/cpmkCreate{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkCreate'])->name('create.cpmk');
    // Route::post('/cpmkCreate{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkStore'])->name('create.cpmk.post');


    Route::get('/list-cpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkList'])->name('list.cpmk');
    Route::get('/peta-cpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkIndex'])->name('peta.cpmk');
    Route::get('/cpmk/{id}/delete', [ak_kurikulum_cpmk_controller::class, 'delete'])->name('delete.cpmk');


    Route::get('/cpmk/edit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkEdit'])->name('edit.cpmk');
    Route::post('/cpmk/edit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkUpdate'])->name('update.cpmk');


    Route::post('/cpmk-store', [ak_kurikulum_cpmk_controller::class, 'cpmkStore'])->name('store.cpmk');
    // Route::get('/cpmkShow/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkShow'])->name('show.cpmk');
    // Route::post('/cpmkShow/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkMapping'])->name('show.cpmk.post');
    // Route::get('/cpmkEdit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkEditGet'])->name('edit.cpmk');
    // Route::post('/cpmkEdit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkEditPOST'])->name('edit.cpmk.post');


    // MATAKULIAH

    Route::get('/matakuliah', [ak_matakuliah_controller::class, 'mkIndex'])->name('index.mk');
    Route::get('/matakuliah/Create', [ak_matakuliah_controller::class, 'mkCreate'])->name('create.mk');
    Route::post('/matakuliah/Store', [ak_matakuliah_controller::class, 'mkStore'])->name('store.mk');

    Route::post('/matakuliah/copyMK', [ak_matakuliah_controller::class, 'copyMatakuliah'])->name('copy.mk');

    Route::get('/detail-mk/{id}', [ak_matakuliah_controller::class, 'subbkDetail'])->name('detail.mk'); // detail MK
    Route::post('/detail-mk/{id}', [ak_matakuliah_controller::class, 'postsubbkDetail'])->name('post.detail.mk'); // detail MK
    Route::get('/detail-mk/{id}/sub-bk', [ak_matakuliah_controller::class, 'kelolaSubBK'])->name('mk.subbk'); // kelola subbk
    Route::post('/detail-mk/{id}/sub-bk', [ak_matakuliah_controller::class, 'postkelolaSubBK']);

    Route::get('/detail-mk/{id}/cpmk/{sub}', [ak_matakuliah_controller::class, 'subbkCPMK'])->name('subbk.cpmk'); // kelola subbk cpmk
    Route::post('/detail-mk/{id}/cpmk/{sub}', [ak_matakuliah_controller::class, 'postsubbkSKS']);
    Route::get('/detail-mk/{id}/cpmk/{sub}/kelola-cpmk', [ak_matakuliah_controller::class, 'kelolacpmk'])->name('subbk.cpmk.kelola'); // kelola subbk cpmk
    Route::post('/detail-mk/{id}/cpmk/{sub}/kelola-cpmk', [ak_matakuliah_controller::class, 'postkelolacpmk']);

    // Organisasi Matakuliah

    Route::get('/organisasi-matakuliah', [organisasiMkController::class, 'orgMKShow'])->name('organisasi.mk');
    Route::post('/organisasi-matakuliah', [organisasiMkController::class, 'kelolaMKWPOST']);

    Route::post('/copy-matakuliah', [organisasiMkController::class, 'copyMatakuliah'])->name('copy.mk');

    Route::post('/tema-store', [organisasiMkController::class, 'temaSTORE'])->name('store.tema');

    Route::get('/reset/{id}', [organisasiMkController::class, 'semesterOrigin'])->name('reset.mk');

    // Metode Penilaian Matakuliah

    Route::get('/metode-penilaian', [metodePenilaianController::class, 'index'])->name('index.metopen');
    Route::post('/metode-penilaian', [metodePenilaianController::class, 'postIndex']);
    Route::post('/metode-penilaian/keterangan', [metodePenilaianController::class, 'tugasPost'])->name('tugas.keterangan');
    Route::get('/metopen', [metodePenilaianController::class, 'metodePenilaian'])->name('metopen');
    Route::post('/post-metopen', [metodePenilaianController::class, 'store'])->name('post.metopen');
    Route::get('/metopen/{id}', [metodePenilaianController::class, 'delete'])->name('delete.metopen');

    Route::get('/metode-penilaian/store/{id}', [metodePenilaianController::class, 'kelolaMetopen'])->name('metopen.cpmk');
    Route::post('/metode-penilaian/store/{id}', [metodePenilaianController::class, 'postKelolaMetopen']);




    // Tugas

    Route::get('/metode-penilaian/tugas/{id}', [metodePenilaianController::class, 'tugasIndex'])->name('tugas.metopen');
    Route::get('/list-penilaian/{id}', [metodePenilaianController::class, 'listNilai'])->name('list.metopen');
    Route::post('/list-penilaian/{id}', [metodePenilaianController::class, 'listNilaiPost'])->name('copy.mhs');

    // Penilaian
    Route::get('/penilaian/{id}', [metodePenilaianController::class, 'penilaian'])->name('index.penilaian');
    Route::post('/penilaian/{id}', [metodePenilaianController::class, 'postPenilaian'])->name('post.nilai');

    // Final Penilaian
    Route::get('/matkul-nilai/{id}', [metodePenilaianController::class, 'finalNilai'])->name('matkul.nilai');
});
