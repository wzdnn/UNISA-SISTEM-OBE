<?php

use App\Http\Controllers\ak_kurikulum_bk_controller;
use App\Http\Controllers\ak_kurikulum_cpl_Controller;
use App\Http\Controllers\ak_kurikulum_cplr_Controller;
use App\Http\Controllers\ak_kurikulum_cpmk_controller;
use App\Http\Controllers\ak_kurikulum_pl_Controller;
use App\Http\Controllers\ak_kurikulum_sub_bk_controller;
use App\Http\Controllers\ak_kurikulum_sub_cpmk_controller;
use App\Http\Controllers\ak_matakuliah;
use App\Http\Controllers\ak_matakuliah_controller;
use App\Http\Controllers\aspekController;
use App\Http\Controllers\basisIlmuController;
use App\Http\Controllers\bidangIlmuController;
use App\Http\Controllers\matakuliah;
use App\Http\Controllers\metodePenilaianController;
use App\Http\Controllers\organisasiMkController;
use App\Http\Controllers\pengalamanMahasiswaController;
use App\Http\Controllers\rekap_controller;
use App\Http\Controllers\rps_controller;
use App\Http\Controllers\strukturProgram_controller;
use App\Http\Controllers\sumberController;
use App\Http\Controllers\timeline_controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\visimisiController;
use App\Models\ak_kurikulum_bk;
use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_sub_cpmk;
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


    // Pengalaman Mahasiswa
    Route::get('/pengalaman-mahasiswa', [pengalamanMahasiswaController::class, 'indexPengalamanMahasiswa'])->name('index.pengalaman');
    Route::post('/pengalaman-mahasiswa/store', [pengalamanMahasiswaController::class, 'storePengalamanMahasiswa'])->name('post.pengalaman');
    Route::get('/pengalaman-mahasiswa/{id}', [pengalamanMahasiswaController::class, 'delete'])->name('delete.pengalaman');


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
    Route::get('/list-cpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkList'])->name('list.cpmk');
    Route::get('/peta-cpmk', [ak_kurikulum_cpmk_controller::class, 'cpmkIndex'])->name('peta.cpmk');
    Route::get('/cpmk/{id}/delete', [ak_kurikulum_cpmk_controller::class, 'delete'])->name('delete.cpmk');
    Route::get('/cpmk/edit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkEdit'])->name('edit.cpmk');
    Route::post('/cpmk/edit/{id}', [ak_kurikulum_cpmk_controller::class, 'cpmkUpdate'])->name('update.cpmk');
    Route::post('/cpmk-store', [ak_kurikulum_cpmk_controller::class, 'cpmkStore'])->name('store.cpmk');

    // Sub CPMK
    route::get('/sub-cpmk', [ak_kurikulum_sub_cpmk_controller::class, 'index'])->name('subcpmk.index');
    route::get('/sub-cpmk/create', [ak_kurikulum_sub_cpmk_controller::class, 'create'])->name('subcpmk.create');
    route::post('/sub-cpmk/store', [ak_kurikulum_sub_cpmk_controller::class, 'store'])->name('subcpmk.store');
    route::get('/sub-cpmk/{id}/edit', [ak_kurikulum_sub_cpmk_controller::class, 'edit'])->name('subcpmk.edit');
    route::post('/sub-cpmk/{id}/edit', [ak_kurikulum_sub_cpmk_controller::class, 'update'])->name('subcpmk.update');
    route::get('/sub-cpmk/{id}/delete', [ak_kurikulum_sub_cpmk_controller::class, 'delete'])->name('subpcmk.delete');

    // MATAKULIAH

    Route::get('/matakuliah', [ak_matakuliah_controller::class, 'mkIndex'])->name('index.mk');
    Route::get('/matakuliah/Create', [ak_matakuliah_controller::class, 'mkCreate'])->name('create.mk');
    Route::post('/matakuliah/Store', [ak_matakuliah_controller::class, 'mkStore'])->name('store.mk');

    // Route::post('/matakuliah/copyMK', [ak_matakuliah_controller::class, 'copyMatakuliah'])->name('copy.mk');

    Route::get('/matakuliah/{id}/', [ak_matakuliah_controller::class, 'subbkDetail'])->name('detail.mk'); // detail MK
    Route::post('/matakuliah/{id}', [ak_matakuliah_controller::class, 'postsubbkDetail'])->name('post.detail.mk'); // detail MK
    Route::get('/matakuliah/{id}/sub-bk', [ak_matakuliah_controller::class, 'kelolaSubBK'])->name('mk.subbk'); // kelola subbk
    Route::post('/matakuliah/{id}/sub-bk', [ak_matakuliah_controller::class, 'postkelolaSubBK']);

    Route::get('/matakuliah/{id}/sub-bk/{sub}', [ak_matakuliah_controller::class, 'subbkCPMK'])->name('subbk.cpmk'); // kelola subbk cpmk
    Route::post('/matakuliah/{id}/sub-bk/{sub}', [ak_matakuliah_controller::class, 'postsubbkSKS']);
    Route::get('/matakuliah/{id}/sub-bk/{sub}/kelola-cpmk', [ak_matakuliah_controller::class, 'kelolacpmk'])->name('subbk.cpmk.kelola'); // kelola subbk cpmk
    Route::post('/matakuliah/{id}/sub-bk/{sub}/kelola-cpmk', [ak_matakuliah_controller::class, 'postkelolacpmk']);


    route::get('/matakuliah/{id}/detail/', [ak_matakuliah_controller::class, 'detailIndex'])->name('detail.index');

    route::post('/matakuliah/{id}/detail/store', [ak_matakuliah_controller::class, 'detailStore'])->name('detail.store');
    route::post('/matakuliah/{id}/detail-referensi/store', [ak_matakuliah_controller::class, 'detailReferensiStore'])->name('detail.referensi.store');

    route::get('/matakuliah/delete-pengalaman-sinkron/{id}', [ak_matakuliah_controller::class, 'deletePengalamanSinkron'])->name('pengalaman-sinkron.delete');
    route::get('/matakuliah/delete-pengalaman-asinkron/{id}', [ak_matakuliah_controller::class, 'deletePengalamanAsinkron'])->name('pengalaman-asinkron.delete');


    //Delete referensi pada Detail-MK
    Route::get('/deleteReferensiUtama/{id}', [ak_matakuliah_controller::class, 'deleteReferensiUtama'])->name('delete.referensi.utama');
    Route::get('/deleteReferensiTambahan/{id}', [ak_matakuliah_controller::class, 'deleteReferensiTambahan'])->name('delete.referensi.tambahan');
    Route::get('/deleteReferensiLuaran/{id}', [ak_matakuliah_controller::class, 'deleteReferensiLuaran'])->name('delete.referensi.luaran');


    //Timeline Matakuliah
    route::get('/matakuliah/{id}/timeline', [timeline_controller::class, 'timeline'])->name('timeline.index');
    route::get('/matakuliah/{id}/timeline/create', [timeline_controller::class, 'createTimeline'])->name('timeline.create');
    route::get('/matakuliah/{id}/timeline/edit/{kdtimeline}', [timeline_controller::class, 'editTimeline'])->name('timeline.edit');
    route::post('/matakuliah/{id}/timeline/create', [timeline_controller::class, 'storeTimeline'])->name('timeline.store');
    route::get('/timeline/{id}/delete', [timeline_controller::class, 'deleteTimeline'])->name('timeline.delete');
    route::post('/timeline/{id}/update', [timeline_controller::class, 'updateTimeline'])->name('timeline.update');

    Route::delete('/matakuliah/{id}/timeline/{kdtimeline}/dosen/{kdperson}', [timeline_controller::class, 'deleteDosen'])->name('timeline.deleteDosen');

    Route::get('/get-metodepembelajaran/{cpmk_id}', [timeline_controller::class, 'getMetodePembelajaran']);

    route::get('/get-metodepembelajaran/{cpmk_id}', [timeline_controller::class, 'getMetodePembelajaranByCpmk'])->name('get-metodepembelajaran');
    route::get('/get-subcpmk/{cpmk_id}', [timeline_controller::class, 'getSubCpmkByCpmk'])->name('get-subcpmk');

    // RPS Matakuliah
    route::get('/matakuliah/{id}/rps/{semester}/preview', [rps_controller::class, 'rps'])->name('rps.preview');
    route::get('/matakuliah/{id}/rps/index', [rps_controller::class, 'index'])->name('rps.index');
    route::get('/matakuliah/{id}/rps/{semester}/detail', [rps_controller::class, 'detail'])->name('rps.detail');

    route::post('/matakuliah/{id}/rps/{semester}/file-upload', [rps_controller::class, 'fileUploadPost'])->name('rps.upload');
    route::get('/matakuliah/{id}/rps/{semester}/delete/{kdfile}', [rps_controller::class, 'delete'])->name('rps.delete');


    //Struktur Program Matakuliah
    route::get('/struktur-program', [strukturProgram_controller::class, 'strukturProgramIndex'])->name('sp.index');
    route::get('/struktur-program/create', [strukturProgram_controller::class, 'strukturProgramCreate'])->name('sp.create');
    route::post('/struktur-program/store', [strukturProgram_controller::class, 'strukturProgramStore'])->name('sp.store');
    route::get('/struktur-program/{id}/delete', [strukturProgram_controller::class, 'strukturProgramDelete'])->name('sp.delete');
    route::get('/struktur-program/{id}/edit', [strukturProgram_controller::class, 'strukturProgramEdit'])->name('sp.edit');
    route::post('/struktur-program/{id}/update', [strukturProgram_controller::class, 'strukturProgramUpdate'])->name('sp.update');

    // Materi Pembelajaran Pada SUBBK
    Route::post('/materiStore', [ak_matakuliah_controller::class, 'storeMateri'])->name('store.materi');
    Route::get('/matakuliah/{id}/sub-bk/{sub}/materi/{materi}', [ak_matakuliah_controller::class, 'indexMateri'])->name('index.materi');
    Route::post('/matakuliah/{id}/sub-bk/{sub}/materi/{materi}', [ak_matakuliah_controller::class, 'postsubbkSKS']);
    Route::get('/delete-materi/{materi}', [ak_matakuliah_controller::class, 'deleteMateri'])->name('delete.materi');


    // Matakuliah - SUBBK
    Route::get('/matakuliah/{id}/sub-bk/{sub}', [ak_matakuliah_controller::class, 'subbkCPMK'])->name('subbk.cpmk'); // kelola subbk cpmk
    Route::get('/matakuliah/{id}/sub-bk/{sub}/kelola-cpmk', [ak_matakuliah_controller::class, 'kelolacpmk'])->name('subbk.cpmk.kelola'); // kelola subbk cpmk
    Route::post('/matakuliah/{id}/sub-bk/{sub}/kelola-cpmk', [ak_matakuliah_controller::class, 'postkelolacpmk']);


    // detail Subbk-CPMK
    Route::get('/detail-mk/{id}/sub-bk/{sub}/cpmk/{id_cpmk}', [ak_matakuliah_controller::class, 'cpmkPembelajaran'])->name('cpmkPembelajaran.index');
    Route::post('/detail-mk/{id}/sub-bk/{sub}/cpmk/{id_cpmk}', [ak_matakuliah_controller::class, 'postCpmkPembelajaran']);


    // Organisasi Matakuliah

    Route::get('/organisasi-matakuliah', [organisasiMkController::class, 'orgMKShow'])->name('organisasi.mk');
    Route::post('/organisasi-matakuliah', [organisasiMkController::class, 'kelolaMKWPOST']);

    Route::post('/copy-matakuliah', [organisasiMkController::class, 'copyMatakuliah'])->name('copy.mk');

    Route::post('/tema-store', [organisasiMkController::class, 'temaSTORE'])->name('store.tema');
    route::get('/tema-delete/{id}', [organisasiMkController::class, 'temaDelete'])->name('delete.tema');

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
    Route::get('/check-data/{gmcId}', [metodePenilaianController::class, 'checkData']);
    Route::get('/list-penilaian/{id}', [metodePenilaianController::class, 'listNilai'])->name('list.metopen');
    Route::post('/list-penilaian/{id}', [metodePenilaianController::class, 'listNilaiPost'])->name('copy.mhs');
    Route::post('/ambil-nilai/{id}', [metodePenilaianController::class, 'ambilNilai'])->name('ambil.nilai');
    Route::post('/list-update/{id}', [metodePenilaianController::class, 'listNilaiUpdate'])->name('update.list');

    // Delete List Penilaian

    route::get('/list-penilaian/{kdjenisnilai}/delete', [metodePenilaianController::class, 'listNilaiDelete'])->name('list.delete');

    // Penilaian
    Route::get('/penilaian/{id}/{kdtahunakademik}', [metodePenilaianController::class, 'penilaian'])->name('index.penilaian');
    Route::post('/penilaian/{id}/{kdtahunakademik}', [metodePenilaianController::class, 'postPenilaian'])->name('post.nilai');

    // Penilaian - rubrik
    Route::post('/penilaian/{id}/{kdtahunakademik}/rubik/upload', [metodePenilaianController::class, 'penilaianUploadPost'])->name('rubik.post');
    Route::get('/penilaian/{id}/{kdtahunakademik}/rubik/delete/{file_id}', [metodePenilaianController::class, 'penilaianUploadDelete'])->name('rubik.delete');

    // Cetak Penilaian
    Route::get('/cetakPenilaian/{id}/{kdtahunakademik}', [metodePenilaianController::class, 'exportNilai'])->name('export.nilai');

    // Import Penilaian
    Route::post('/importPenilaian/{id}/{kdtahunakademik}', [metodePenilaianController::class, 'importNilai'])->name('import.nilai');

    // Final Penilaian
    Route::get('/matkul-nilai/{id}', [metodePenilaianController::class, 'finalNilai'])->name('matkul.nilai');

    // Rekap 
    Route::get('/rekap', [rekap_controller::class, 'rekap'])->name('rekap.index');
    Route::get('/rekap-semester/{id}', [rekap_controller::class, 'indexSemester'])->name('rekap.semester.index');
    Route::get('/rekap-semester/{id}/result/{semester}', [rekap_controller::class, 'rekapSemester'])->name('rekap.semester');
    Route::get('/rekap-tahunan/{id}', [rekap_controller::class, 'rekapTahunan'])->name('rekap.tahunan');
    Route::get('/rekap-mahasiswa', [rekap_controller::class, 'rekapMahasiswaGet'])->name('rekap.mahasiswa.get');
    // Route::post('/rekap-mahasiswa/{nim}', [rekap_controller::class, 'rekapMahasiswaPost'])->name('rekap.mahasiswa.post');
});
