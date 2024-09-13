<?php

namespace App\Http\Controllers;

use App\Models\ak_aksesmedia;
use App\Models\ak_kurikulum_cpmk;
use App\Models\ak_kurikulum_sub_bk;
use App\Models\ak_kurikulum_sub_bk_materi;
use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_cpmk;
use App\Models\ak_matakuliah_dosen_pelaporan;
use App\Models\ak_matakuliah_dosen_utama;
use App\Models\ak_matakuliah_referensi_luaran;
use App\Models\ak_matakuliah_referensi_tambahan;
use App\Models\ak_matakuliah_referensi_utama;
use App\Models\ak_matakuliah_subbk;
use App\Models\ak_metodepembelajaran;
use App\Models\ak_pengalamanmahasiswa;
use App\Models\ak_referensi;
use App\Models\ak_strukturprogram;
use App\Models\ak_tahunakademik;
use App\Models\ak_timeline;
use App\Models\gabung_cpmk_pembelajaran;
use App\Models\gabung_matakuliah_akses;
use App\Models\gabung_matakuliah_pengalaman_asinkron;
use App\Models\gabung_matakuliah_pengalaman_sinkron;
use App\Models\gabung_matakuliah_subbk;
use App\Models\gabung_subbk_cpmk;
use App\Models\mk_sub_bk;
use App\Models\rekomendasisks;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

use function Laravel\Prompts\select;

class ak_matakuliah_controller extends Controller
{

    public function mkIndex(Request $request)
    {

        if (auth()->user()->kdunit == 42) {
            $matakuliah = ak_matakuliah::with('MKtoSub_bk.SBKtoidCPMK', 'MKtoSub_bk.getSBKtoidCPMK', 'GetAllidSubBK')
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->where("ak_kurikulum.isObe", '=', 1)
                ->orderBy('kdmatakuliah', 'asc');

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 2) {
            $matakuliah = ak_matakuliah::with('MKtoSub_bk.SBKtoidCPMK', 'MKtoSub_bk.getSBKtoidCPMK', 'GetAllidSubBK')
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->where("ak_kurikulum.isObe", '=', 1)
                ->where('ak_kurikulum.kdkurikulum', 67)
                ->orderBy('kdmatakuliah', 'asc');

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->where('ak_kurikulum.kdkurikulum', 67)
                ->get();
        } else {
            $matakuliah = ak_matakuliah::with('MKtoSub_bk.SBKtoidCPMK', 'MKtoSub_bk.getSBKtoidCPMK', 'GetAllidSubBK')
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->where("ak_kurikulum.isObe", '=', 1)
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit);
                })
                ->orderBy('kdmatakuliah', 'asc');

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();
        }

        // dd($request->input('filter-kurikulum'));

        // excecute sql
        $matakuliah = $matakuliah
            ->when($request->input('filter-matakuliah') != '' || $request->input('filter-matakuliah') != null, function ($query) use ($request) {
                $query->where('matakuliah', 'like', "%" . $request->input("filter-matakuliah") . "%");
            })
            ->when($request->input('filter-kurikulum') != null || $request->input('filter-kurikulum') != '', function ($query) use ($request) {
                $query->where("ak_matakuliah.kdkurikulum", $request->input('filter-kurikulum'));
            })
            ->paginate(10);
        // ->toSql();


        // dd($request->input('filter-matakuliah'), $matakuliah);

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }


        return view('pages.matakuliah.index', compact('matakuliah', 'kdkurikulum'));
    }

    // tambah data
    public function mkCreate()
    {
        $ak_kurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();

        $SBK = DB::table('ak_kurikulum_sub_bks')
            ->select(['id', 'kode_subbk', 'sub_bk'])
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_sub_bks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        return view('pages.matakuliah.create', compact('ak_kurikulum', 'SBK'));
    }

    // method post tambah data
    public function mkStore(Request $request)
    {
        $request->validate([
            'semester'
        ]);

        $matakuliah = ak_matakuliah::create([
            'kodematakuliah' => $request->kodematakuliah,
            'matakuliah' => $request->matakuliah,
            'batasNilai' => $request->batasNilai,
            'kdkurikulum' => $request->unit,
            'isObe' => 1
        ]);

        $matakuliah->MKtoSBKinput()->attach($request->input('kdsubbk'));

        // return dd($matakuliah);


        return redirect()->route('index.mk')->with('success', 'Matakuliah berhasih ditambahkan');
    }

    /**
     * New start
     * 
     * gabungan matakuliah dengan subbk
     */
    public function subbkDetail(int $id, Request $request)
    {

        // dd('test');
        // $filter = ak_tahunakademik::where("isaktif", 1)->orderBy("kdtahunakademik", "asc")->get();
        // $filterLatest = $filter->last();
        // $kelompok = $filter->groupBy("kdtahunakademik")->toArray();

        // $filter = [
        //     "latest" => $filterLatest->kdtahunakademik,
        //     "filter" => array_keys($kelompok)

        // ];


        $filter = ak_tahunakademik::where("isaktif", 1)
            ->orderBy("kdtahunakademik", "asc")
            ->get();

        $filterLatest = $filter->last();
        $kelompok = $filter->groupBy("kdtahunakademik")->toArray();

        $filterData = [
            "latest" => $filterLatest ? $filterLatest->kdtahunakademik : null,
            "filter" => array_keys($kelompok)
        ];

        $selectedFilter = $request->input('filter', $filterData['latest']);

        // dd($filter);

        $rekomendasiSKS = DB::select('call sistem_obe.rekomendasi_sks(?, 144, ?)', [Auth::user()->kdunit, $id]);

        $mkSubBk = ak_matakuliah::with('MKtoSub_bk')->findOrFail($id);




        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();


        if ($request->has("filter")) {
            $referensiUtama = ak_matakuliah_referensi_utama::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_utama.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_utama.id_referensi")
                ->where("kdtahunakademik", "=", $request->filter)
                ->paginate(15);

            $referensiTambahan = ak_matakuliah_referensi_tambahan::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_tambahan.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_tambahan.id_referensi")
                ->where("kdtahunakademik", "=", $request->filter)
                ->paginate(15);

            $referensiLuaran = ak_matakuliah_referensi_luaran::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_luaran.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_luaran.id_referensi")
                ->where("kdtahunakademik", "=", $request->filter)
                ->paginate(15);


            $pengalamanSinkron = gabung_matakuliah_pengalaman_sinkron::where('mk.kdmatakuliah', "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_pengalaman_sinkron.kdmatakuliah")
                // ->join("ak_pengalamanmahasiswa as pm", "pm.id", "=", "gabung_matakuliah_pengalaman_sinkron.id_pengalaman")
                ->with('sinkron_pivot')
                ->where("kdtahunakademik", "=", $request->filter)
                ->paginate(15);


            $pengalamanAsinkron = gabung_matakuliah_pengalaman_asinkron::where('mk.kdmatakuliah', "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_pengalaman_asinkron.kdmatakuliah")
                // ->join("ak_pengalamanmahasiswa as pm", "pm.id", "=", "gabung_matakuliah_pengalaman_asinkron.id_pengalaman")
                ->with('asinkron_pivot')
                ->where("kdtahunakademik", "=", $request->filter)
                ->paginate(15);

            $akses = gabung_matakuliah_akses::where('mk.kdmatakuliah', '=', $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_akses.kdmatakuliah")
                ->join("ak_aksesmedia as akses", "akses.kdakses", "=", "gabung_matakuliah_akses.kdakses")
                ->where("kdtahunakademik", "=", " $request->filter")
                ->first();
        } else {
            $referensiUtama = ak_matakuliah_referensi_utama::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_utama.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_utama.id_referensi")
                ->where("kdtahunakademik", $filterData["latest"])
                ->paginate(15);

            $referensiTambahan = ak_matakuliah_referensi_tambahan::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_tambahan.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_tambahan.id_referensi")
                ->where("kdtahunakademik", $filterData["latest"])
                ->paginate(15);

            $referensiLuaran = ak_matakuliah_referensi_luaran::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_luaran.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_luaran.id_referensi")
                ->where("kdtahunakademik", $filterData["latest"])
                ->paginate(15);

            $pengalamanSinkron = gabung_matakuliah_pengalaman_sinkron::where('mk.kdmatakuliah', "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_pengalaman_sinkron.kdmatakuliah")
                // ->join("ak_pengalamanmahasiswa as pm", "pm.id", "=", "gabung_matakuliah_pengalaman_sinkron.id_pengalaman")
                ->with('sinkron_pivot')
                ->where("kdtahunakademik", $filterData["latest"])
                ->paginate(15);

            $pengalamanAsinkron = gabung_matakuliah_pengalaman_asinkron::where('mk.kdmatakuliah', "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_pengalaman_asinkron.kdmatakuliah")
                // ->join("ak_pengalamanmahasiswa as pm", "pm.id", "=", "gabung_matakuliah_pengalaman_asinkron.id_pengalaman")
                ->with('asinkron_pivot')
                ->where("kdtahunakademik", $filterData["latest"])
                ->paginate(15);

            $akses = gabung_matakuliah_akses::where('mk.kdmatakuliah', '=', $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_akses.kdmatakuliah")
                ->join("ak_aksesmedia as akses", "akses.kdakses", "=", "gabung_matakuliah_akses.kdakses")
                ->where("kdtahunakademik", $filterData["latest"])
                ->first();
        }

        // dd($pengalamanSinkron);

        return view('pages.matakuliah.detail2', [
            'filter' => $filterData,
            'selectedFilter' => $selectedFilter
        ], compact('mkSubBk', 'rekomendasiSKS', 'referensiUtama', 'referensiTambahan', 'referensiLuaran', 'tahunAkademik', 'pengalamanSinkron', 'pengalamanAsinkron', 'akses', 'filter', 'kelompok'));
    }

    public function postsubbkDetail(int $id, Request $request)
    {



        $request->validate([
            'kodematakuliah' => 'nullable',
            'matakuliah' => 'nullable',
            'mk_singkat' => 'nullable',
        ]);

        // return dd($request->all());

        try {
            $mkSubBk = ak_matakuliah::where('kdmatakuliah', '=', $id)->with('pengalamanSinkron', 'pengalamanAsinkron')->first();

            $mkSubBk->kodematakuliah = $request->input('kodematakuliah');
            $mkSubBk->matakuliah = $request->input('matakuliah');
            $mkSubBk->mk_singkat = $request->input('mk_singkat');
            $mkSubBk->sks = $request->input('sks');
            $mkSubBk->batasNilai = $request->input('batasNilai');
            $mkSubBk->deskripsi_mk = $request->input('deskripsi_mk');
            $mkSubBk->akses_media = $request->input('akses_media');


            $mkSubBk->save();

            return redirect()->back()->with('success', 'berhasil update data Matakuliah');
        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'gagal update data Matakuliah. Error: ' . $th->getMessage());
        }
    }

    public function kelolaSubBK(int $id)
    {

        $mkSubBk = ak_matakuliah::where('kdmatakuliah', '=', $id)->with('GetAllidSubBK')->first();
        // $subbk = ak_kurikulum_sub_bk::all();

        $subbk = ak_kurikulum_sub_bk::with('SBKtoMK')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_sub_bks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $subbkSelect = [];
        foreach ($mkSubBk->GetAllidSubBK as $item) {
            array_push($subbkSelect, $item->ak_kurikulum_sub_bk_id);
        }

        // return dd($mkSubBk);

        return view('pages.matakuliah.subbk', compact('subbk', 'subbkSelect', 'id'));
    }


    public function postkelolaSubBK(int $id, Request $request)
    {
        $subkSelect = [];
        // validate
        if ($request->has('subbk')) {
            foreach ($request->input("subbk") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($subkSelect, $value);
                }
            }
        }

        try {
            $matkul = ak_matakuliah::where("kdmatakuliah", "=", $id)->with("MKtoSub_bk")->first();

            DB::beginTransaction();
            if (count($subkSelect) > 0) {
                $matkul->MKtoSub_bk()->sync($subkSelect);
            } else {
                $matkul->MKtoSub_bk()->detach();
            }

            DB::commit();
            return redirect()->back()->with("success", "berhasil update Sub BK pada Matkul");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("failed", "gagal update Sub BK pada Matkul" . $th->getMessage());
        }
    }

    public function getTotalAccumulatedTime(int $id_gabung)
    {
        $subbkRecords = ak_kurikulum_sub_bk_materi::where('id_gabung', $id_gabung)->get();

        $totalAccumulatedTime = $subbkRecords->reduce(function ($carry, $subbk) {
            return $carry +
                ($subbk->kuliah ?? 0) +
                ($subbk->tutorial ?? 0) +
                ($subbk->seminar ?? 0) +
                ($subbk->praktikum ?? 0) +
                ($subbk->skill_lab ?? 0) +
                ($subbk->field_lab ?? 0) +
                ($subbk->praktik ?? 0) +
                ($subbk->penugasan ?? 0) +
                ($subbk->belajar_mandiri ?? 0);
        }, 0);

        return $totalAccumulatedTime;
    }

    public function getTotalAccumulatedTimeByMatakuliah($kdmatakuliah)
    {
        // Cari gabungan matakuliah berdasarkan kdmatakuliah
        $gabungMatakuliah = gabung_matakuliah_subbk::where('kdmatakuliah', $kdmatakuliah)->get();

        // Ambil semua materi terkait yang berhubungan dengan kdmatakuliah tersebut
        $totalAccumulatedTime = 0;

        foreach ($gabungMatakuliah as $gabung) {
            // Cari semua subbk terkait id_gabung dari gabung_matakuliah_subbk
            $subbkRecords = $gabung->subbkMateri;

            // Hitung total waktu akumulasi dari semua subbk
            $totalAccumulatedTime += $subbkRecords->reduce(function ($carry, $subbk) {
                return $carry +
                    ($subbk->kuliah ?? 0) +
                    ($subbk->tutorial ?? 0) +
                    ($subbk->seminar ?? 0) +
                    ($subbk->praktikum ?? 0) +
                    ($subbk->skill_lab ?? 0) +
                    ($subbk->field_lab ?? 0) +
                    ($subbk->praktik ?? 0) +
                    ($subbk->penugasan ?? 0) +
                    ($subbk->belajar_mandiri ?? 0);
            }, 0);
        }

        return $totalAccumulatedTime;
    }


    // detail sub bk dan cpmk
    public function subbkCPMK(int $id, int $sub)
    {
        $subbk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('subbk', 'cpmks')->first();

        $mkSubBk = ak_matakuliah::with('MKtoSub_bk')->where('kdmatakuliah', '=', $id)->first();

        $materi = ak_kurikulum_sub_bk_materi::join('ak_matakuliah_ak_kurikulum_sub_bk', 'ak_matakuliah_ak_kurikulum_sub_bk.id', 'ak_kurikulum_sub_bk_materi.id_gabung')
            ->where('id_gabung', $sub)->get();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();

        if (!$subbk) {
            return abort(404);
        }

        $totalAccumulatedTime = $this->getTotalAccumulatedTimeByMatakuliah($id);

        $total_waktu = 2700 * $mkSubBk->sks;
        // dd($materi);

        return view('pages.matakuliah.detail-subbk', compact('id', 'sub', 'subbk', 'mkSubBk', 'materi', 'tahunAkademik', 'total_waktu', 'totalAccumulatedTime'));
    }

    public function indexMateri(int $id, int $sub, int $materi)
    {

        $mkSubBk = ak_matakuliah::with('MKtoSub_bk')->where('kdmatakuliah', '=', $id)->first();

        $detail = gabung_matakuliah_subbk::where('id', $sub)->with('subbk', 'cpmks')->first();

        $subbk = ak_kurikulum_sub_bk_materi::where('kdmateri', $materi)->first();

        // Get the id_gabung from the subbk record or another relevant place
        $id_gabung = $subbk->id_gabung;

        $totalAccumulatedTime = $this->getTotalAccumulatedTimeByMatakuliah($id);

        $total_waktu = 2700 * $mkSubBk->sks;


        // dd($detail);

        return view('pages.matakuliah.detail-subbk-materi', compact('subbk', 'id', 'detail', 'mkSubBk', 'total_waktu', 'totalAccumulatedTime'));
    }

    public function deleteMateri(int $materi)
    {
        $subbkMateri = ak_kurikulum_sub_bk_materi::findOrFail($materi);

        $subbkMateri->delete();

        return redirect()->back()->with('success', 'data berhasil dihapus');
    }

    public function storeMateri(Request $request)
    {
        $request->validate(['materi_pembelajaran']);

        ak_kurikulum_sub_bk_materi::create([
            'id_gabung' => $request->materi_input_id,
            'materi_pembelajaran' => $request->materi,
            'kdtahunakademik' => $request->tahunakademik
        ]);

        return redirect()->back()->with('success', ' Materi Pembelajaran Berhasil Ditambahkan');
    }

    public function postsubbkSKS(int $id, int $sub, int $materi, Request $request)
    {
        $request->validate([
            'materi_pembelajaran' => 'nullable',
            'kuliah' => ['nullable', 'numeric'],
            'tutorial' => ['nullable', 'numeric'],
            'seminar' => ['nullable', 'numeric'],
            'praktikum' => ['nullable', 'numeric'],
            'skill_lab' => ['nullable', 'numeric'],
            'field_lab' => ['nullable', 'numeric'],
            'praktik' => ['nullable', 'numeric'],
            'penugasan' => ['nullable', 'numeric'],
            'belajar_mandiri' => ['nullable', 'numeric']
        ]);

        try {
            $subbk = ak_kurikulum_sub_bk_materi::where('kdmateri', $materi)->first();

            // Fetch existing total accumulated time
            $existingTotal = $subbk->kuliah + $subbk->tutorial + $subbk->seminar + $subbk->praktikum +
                $subbk->skill_lab + $subbk->field_lab + $subbk->praktik + $subbk->penugasan +
                $subbk->belajar_mandiri;

            // Calculate new total input from the request
            $newInput = ($request->input('kuliah') ?? 0) +
                ($request->input('tutorial') ?? 0) +
                ($request->input('seminar') ?? 0) +
                ($request->input('praktikum') ?? 0) +
                ($request->input('skill_lab') ?? 0) +
                ($request->input('field_lab') ?? 0) +
                ($request->input('praktik') ?? 0) +
                ($request->input('penugasan') ?? 0) +
                ($request->input('belajar_mandiri') ?? 0);

            // Calculate the total accumulated time including new inputs
            $totalInput = $existingTotal + $newInput;

            // Get total waktu
            $mkSubBk = ak_matakuliah::with('MKtoSub_bk')->where('kdmatakuliah', '=', $id)->first();
            $total_waktu = 2700 * $mkSubBk->sks;

            // Check if the new total exceeds the allowed maximum time
            if ($totalInput > $total_waktu) {
                return redirect()->back()->withErrors([
                    'total' => "Total waktu yang diinput ($totalInput menit) melebihi batas maksimum ($total_waktu menit)."
                ])->withInput();
            }

            $subbk->materi_pembelajaran = $request->input('materi_pembelajaran');
            $subbk->kuliah = $request->input('kuliah');
            $subbk->tutorial = $request->input('tutorial');
            $subbk->seminar = $request->input('seminar');
            $subbk->praktikum = $request->input('praktikum');
            $subbk->skill_lab = $request->input('skill_lab');
            $subbk->field_lab = $request->input('field_lab');
            $subbk->praktik = $request->input('praktik');
            $subbk->penugasan = $request->input('penugasan');
            $subbk->belajar_mandiri = $request->input('belajar_mandiri');

            $subbk->save();

            return redirect()->back()->with('success', 'berhasil update SKS');
        } catch (Throwable $th) {

            return redirect()->back()->with('failed', 'gagal update SKS. Error: ' . $th->getMessage());
        }
    }

    // Metod ePembelajaran
    public function cpmkPembelajaran(int $id, int $sub, int $id_cpmk)
    {
        $pembelajaran = ak_metodepembelajaran::with('pembelajaran')->get();

        $subbk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('subbk', 'cpmks')->first();

        $mkSubBk = ak_matakuliah::with('MKtoSub_bk')->where('kdmatakuliah', '=', $id)->first();

        $detailCpmk = gabung_subbk_cpmk::with('pembelajaran')
            ->where('gabung_subbk_cpmks.id', '=', $id_cpmk)
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', '=', 'gabung_subbk_cpmks.id_cpmk')
            ->first();

        $cpmk = gabung_subbk_cpmk::with('pembelajaran')
            ->where('gabung_subbk_cpmks.id', '=', $id_cpmk)
            // ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', '=', 'gabung_subbk_cpmks.id_cpmk')
            ->first();

        // dump($cpmk);
        // return;
        $id_pembelajaran = [];
        foreach ($cpmk->pembelajaran as $data) {
            $id_pembelajaran[] = $data->id;
        }

        // dd($cpmk);

        return view('pages.matakuliah.detail-cpmk', compact('id', 'sub', 'cpmk', 'subbk', 'mkSubBk', 'id_pembelajaran', 'pembelajaran', 'detailCpmk'));
    }

    public function postCpmkPembelajaran(int $id, int $sub, int $id_cpmk, Request $request)
    {
        $pembelajaranSelect = [];
        if ($request->has('pembelajaranSelect')) {
            foreach ($request->input("pembelajaranSelect") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($pembelajaranSelect, $value);
                }
            }
        }

        try {

            $cpmkPembelajaran = gabung_subbk_cpmk::with('pembelajaran')->findOrFail($id_cpmk);
            DB::beginTransaction();

            if (count($pembelajaranSelect) > 0) {
                $cpmkPembelajaran->pembelajaran()->sync($pembelajaranSelect);
            } else {
                $cpmkPembelajaran->pembelajaran()->detach();
            }
            DB::commit();

            return redirect()->back()->with("success", "berhasil update Metode Pembelajaran pada CPMK");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("failed", "gagal update" . $th->getMessage());
        }
    }


    public function kelolacpmk(int $id, int $sub)
    {
        $subbkCpmk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('cpmks')->first();

        $cpmk = ak_kurikulum_cpmk::all();
        $cpmk = ak_kurikulum_cpmk::with('CPMKtoCPL')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpmks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $subbk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('subbk', 'cpmks')->first();

        $cpmkSelected = [];
        foreach ($subbkCpmk->cpmks as $item) {
            array_push($cpmkSelected, $item->id);
        }

        return view('pages.matakuliah.cpmk', compact('id', 'sub', 'cpmk', 'cpmkSelected', 'subbk'));
    }

    /**
     * New last
     * 
     * post CPMK ke SUB BK
     */
    public function postkelolacpmk(int $id, int $sub, Request $request)
    {
        $cpmkSelect = [];
        // validate
        if ($request->has('cpmk')) {
            foreach ($request->input("cpmk") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($cpmkSelect, $value);
                }
            }
        }

        try {
            $subbkCpmk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('cpmks')->first();
            DB::beginTransaction();
            if (count($cpmkSelect) > 0) {
                $subbkCpmk->cpmks()->sync($cpmkSelect);
            } else {
                $subbkCpmk->cpmks()->detach();
            }
            DB::commit();
            return redirect()->back()->with('success', 'sukses update CPMK');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("failed", "gagal update" . $th->getMessage());
        }
    }

    public function subbkEdit(int $id)
    {
        $sbkEdit = DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
            ->where('ak_kurikulum_sub_bk_id', '=', $id)
            ->get();

        // return dd($sbkEdit);
        return view('', compact('sbkEdit'));
    }

    public function subbkEditStore(Request $request, int $id)
    {
        $check = DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
            ->where('ak_kurikulum_sub_bk_id', '=', $id)
            ->first();

        if ($check) {
            DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
                ->where('id', '=', $id)
                ->update([
                    'pokok_bahasan' => $request->pokok_bahasan,
                    'kuliah' => $request->kuliah,
                    'tutorial' => $request->tutorial,
                    'seminar' => $request->seminar,
                    'praktikum' => $request->praktikum,
                    'skill_lab' => $request->skill_lab,
                    'field_lab' => $request->field_lab,
                    'praktik' => $request->praktik

                ]);
        } else {
            DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
                ->where('ak_kurikulum_sub_bk_id', '=', $id)
                ->insert([
                    'pokok_bahasan' => $request->pokok_bahasan,
                    'kuliah' => $request->kuliah,
                    'tutorial' => $request->tutorial,
                    'seminar' => $request->seminar,
                    'praktikum' => $request->praktikum,
                    'skill_lab' => $request->skill_lab,
                    'field_lab' => $request->field_lab,
                    'praktik' => $request->praktik

                ]);
        }

        return redirect()->route('index.mk');
    }

    // nampilinCPMK
    public function mapCPMKshow(int $id)
    {
        $cpmk = DB::table('ak_kurikulum_cpmks')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpmks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();
        $save = DB::table('subbk_cpmk')
            ->select('ak_kurikulum_cpmk')
            ->where('ak_kurikulum_sub_bk_id', '=', $id)->first();

        // return dd($cpmk);

        $data = [];
        if ($save != null) {
            $save->ak_kurikulum_cpmk = (unserialize($save->ak_kurikulum_cpmk)) ? unserialize($save->ak_kurikulum_cpmk) : null;
            $data = $save->ak_kurikulum_cpmk;
        }

        $save = $data;

        // return dd($save);

        return view('pages.matakuliah.showCPMK', compact('cpmk', 'id', 'save'));
    }

    // mappingCPMK
    public function mappingCPMK(Request $request, int $subbk_id)
    {
        $dataSBKCPMK = array();
        if ($request->cpmk != null) {
            foreach ($request->cpmk as $cpmk) {
                $dataSBKCPMK[] = $cpmk;
            }
        }

        $check = DB::table('subbk_cpmk')
            ->where('ak_kurikulum_sub_bk_id', '=', $subbk_id)
            ->first();

        if ($check) {
            DB::table('subbk_cpmk')
                ->where('ak_kurikulum_sub_bk_id', '=', $subbk_id)
                ->update([
                    'ak_kurikulum_cpmk' => serialize($dataSBKCPMK)
                ]);
        } else {
            DB::table('subbk_cpmk')
                ->where('ak_kurikulum_sub_bk_id', '=', $subbk_id)
                ->insert([
                    'ak_kurikulum_sub_bk_id' => $subbk_id,
                    'ak_kurikulum_cpmk' => serialize($dataSBKCPMK)
                ]);
        }
        return redirect()->route('index.mk');
    }

    // detail matakuliah

    public function detailIndex(int $id, Request $request)
    {

        // Fetch all active academic years
        $filter = ak_tahunakademik::where("isaktif", 1)
            ->orderBy("kdtahunakademik", "asc")
            ->get();

        $filterLatest = $filter->last();
        $kelompok = $filter->groupBy("kdtahunakademik")->toArray();

        $filterData = [
            "latest" => $filterLatest ? $filterLatest->kdtahunakademik : null,
            "filter" => array_keys($kelompok)
        ];

        $selectedFilter = $request->input('filter', $filterData['latest']);

        $mkSubBk = ak_matakuliah::with('MKtoSub_bk', 'pengalamanSinkron', 'pengalamanAsinkron')->findOrFail($id);

        $mkPengalaman = ak_pengalamanmahasiswa::with('pengalamanSinkron', 'pengalamanAsinkron')->get();

        if ($request->has("filter")) {
            $pengalamanSinkron = gabung_matakuliah_pengalaman_sinkron::join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_pengalaman_sinkron.kdmatakuliah")
                ->join("ak_pengalamanmahasiswa as pm", "pm.id", "=", "gabung_matakuliah_pengalaman_sinkron.id_pengalaman")
                ->where("mk.kdmatakuliah", "=", $id)
                ->where("kdtahunakademik", "=", $request->filter) // Ensure correct table prefix
                ->paginate(15);

            $pengalamanAsinkron = gabung_matakuliah_pengalaman_asinkron::join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_pengalaman_asinkron.kdmatakuliah")
                ->join("ak_pengalamanmahasiswa as pm", "pm.id", "=", "gabung_matakuliah_pengalaman_asinkron.id_pengalaman")
                ->where("mk.kdmatakuliah", "=", $id)
                ->where("kdtahunakademik", "=", $request->filter) // Ensure correct table prefix
                ->paginate(15);

            $referensiUtama = ak_matakuliah_referensi_utama::join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_utama.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_utama.id_referensi")
                ->where("mk.kdmatakuliah", "=", $id)
                ->where("kdtahunakademik", "=", $request->filter) // Ensure correct table prefix
                ->get();

            $referensiTambahan = ak_matakuliah_referensi_tambahan::join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_tambahan.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_tambahan.id_referensi")
                ->where("mk.kdmatakuliah", "=", $id)
                ->where("kdtahunakademik", "=", $request->filter) // Ensure correct table prefix
                ->get();

            $referensiLuaran = ak_matakuliah_referensi_luaran::join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_luaran.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_luaran.id_referensi")
                ->where("mk.kdmatakuliah", "=", $id)
                ->where("kdtahunakademik", "=", $request->filter) // Ensure correct table prefix
                ->get();

            $akses = gabung_matakuliah_akses::join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_akses.kdmatakuliah")
                ->join("ak_aksesmedia as akses", "akses.kdakses", "=", "gabung_matakuliah_akses.kdakses")
                ->where("mk.kdmatakuliah", "=", $id)
                ->where("kdtahunakademik", "=", $request->filter) // Ensure correct table prefix
                ->first();

            // Use the filtered collections for looping
            $id_pengalamanSinkron = [];
            foreach ($pengalamanSinkron as $data) { // Adjusted to loop over the filtered collection
                $id_pengalamanSinkron[] = $data->id;
            }

            $id_pengalamanAsinkron = [];
            foreach ($pengalamanAsinkron as $data) { // Adjusted to loop over the filtered collection
                $id_pengalamanAsinkron[] = $data->id;
            }
        } else {

            $pengalamanSinkron = gabung_matakuliah_pengalaman_sinkron::where('mk.kdmatakuliah', "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_pengalaman_sinkron.kdmatakuliah")
                ->join("ak_pengalamanmahasiswa as pm", "pm.id", "=", "gabung_matakuliah_pengalaman_sinkron.id_pengalaman")
                ->where("kdtahunakademik", $filterData["latest"])
                ->paginate(15);

            $pengalamanAsinkron = gabung_matakuliah_pengalaman_asinkron::where('mk.kdmatakuliah', "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_pengalaman_asinkron.kdmatakuliah")
                ->join("ak_pengalamanmahasiswa as pm", "pm.id", "=", "gabung_matakuliah_pengalaman_asinkron.id_pengalaman")
                ->where("kdtahunakademik", $filterData["latest"])
                ->paginate(15);

            $referensiUtama = ak_matakuliah_referensi_utama::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_utama.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_utama.id_referensi")
                ->where("kdtahunakademik", $filterData["latest"])
                ->get();

            $referensiTambahan = ak_matakuliah_referensi_tambahan::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_tambahan.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_tambahan.id_referensi")
                ->where("kdtahunakademik", $filterData["latest"])
                ->get();

            $referensiLuaran = ak_matakuliah_referensi_luaran::where("mk.kdmatakuliah", "=", $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_luaran.kdmatakuliah")
                ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_luaran.id_referensi")
                ->where("kdtahunakademik", $filterData["latest"])
                ->get();

            $akses = gabung_matakuliah_akses::where('mk.kdmatakuliah', '=', $id)
                ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "gabung_matakuliah_akses.kdmatakuliah")
                ->join("ak_aksesmedia as akses", "akses.kdakses", "=", "gabung_matakuliah_akses.kdakses")
                ->where("kdtahunakademik", $filterData["latest"])
                ->first();

            $id_pengalamanSinkron = [];
            foreach ($pengalamanSinkron as $data) {
                $id_pengalamanSinkron[] = $data->id;
            }

            $id_pengalamanAsinkron = [];
            foreach ($pengalamanAsinkron as $data) {
                $id_pengalamanAsinkron[] = $data->id;
            }
        }

        $matakuliah = ak_matakuliah::findOrFail($id);

        return view('pages.detailMatakuliah.index', [
            'filter' => $filterData,
            'selectedFilter' => $selectedFilter
        ], compact('request', 'akses', 'matakuliah', 'mkSubBk', 'mkPengalaman', 'referensiUtama', 'referensiTambahan', 'referensiLuaran', 'id_pengalamanSinkron', 'id_pengalamanAsinkron', 'filter'));
    }

    public function detailStore(Request $request, int $id)
    {


        $this->validate($request, [
            'luring' => 'nullable|numeric|max:100',
            'daring' => 'nullable|numeric|max:100',
            'blended' => 'nullable|numeric|max:100',
        ], [
            'luring.max' => 'Persentase Luring tidak boleh lebih dari 100.',
            'daring.max' => 'Persentase Daring tidak boleh lebih dari 100.',
            'blended.max' => 'Persentase Blended tidak boleh lebih dari 100.'
        ]);


        $filter = ak_tahunakademik::where("isaktif", 1)->orderBy("kdtahunakademik", "desc")->first();


        $mkSubBk = ak_matakuliah::where('kdmatakuliah', '=', $id)->with('pengalamanSinkron', 'pengalamanAsinkron')->first();

        $kdTahunAkademim = $request->has("filter-form") ? $request->input('filter-form') : $filter->kdtahunakademik;

        try {
            DB::beginTransaction();


            $pengalamanSelectSinkron = [];
            if ($request->has('pengalamanSelectSinkron') != '' || $request->has('pengalamanSelectSinkron') != null) {
                foreach ($request->input("pengalamanSelectSinkron") as $key => $value) {
                    if (!is_numeric($value)) {
                        return redirect()->back()->with("failed", "inputan tidak valid");
                    } else {
                        array_push($pengalamanSelectSinkron, $value);
                    }
                }
            }

            $pengalamanSelectAsinkron = [];
            if ($request->has('pengalamanSelectAsinkron') != '' || $request->has('pengalamanSelectAsinkron') != null) {
                foreach ($request->input("pengalamanSelectAsinkron") as $key => $value) {
                    if (!is_numeric($value)) {
                        return redirect()->back()->with("failed", "inputan tidak valid");
                    } else {
                        array_push($pengalamanSelectAsinkron, $value);
                    }
                }
            }


            if ($request->has('akses_media')) {
                $existingAccess = gabung_matakuliah_akses::where('kdmatakuliah', $id)
                    ->where('kdtahunakademik', $kdTahunAkademim)
                    ->first();

                $luring = $request->filled('luring') ? $request->input('luring') : null;
                $daring = $request->filled('daring') ? $request->input('daring') : null;
                $blended = $request->filled('blended') ? $request->input('blended') : null;

                if ($existingAccess) {
                    $akses_media = ak_aksesmedia::where('kdakses', $existingAccess->kdakses)->first();
                    if ($akses_media) {
                        $akses_media->update([
                            'linkakses' => $request->input('akses_media')
                        ]);
                    }

                    $existingAccess->update([
                        'luring' => $luring,
                        'daring' => $daring,
                        'blended' => $blended,
                    ]);
                } else {
                    $akses_media = ak_aksesmedia::create([
                        'linkakses' => $request->input('akses_media') ?? ''
                    ]);

                    gabung_matakuliah_akses::create([
                        'luring' => $luring,
                        'daring' => $daring,
                        'blended' => $blended,
                        "kdmatakuliah" => $id,
                        "kdakses" => $akses_media->kdakses,
                        "kdtahunakademik" => $kdTahunAkademim
                    ]);
                }
            }

            // Sinkron
            if (count($pengalamanSelectSinkron) > 0) {
                DB::table("gabung_matakuliah_pengalaman_sinkron")
                    ->where("kdmatakuliah", $mkSubBk->kdmatakuliah)
                    ->where("kdtahunakademik", $kdTahunAkademim)
                    ->whereNotIn("id_pengalaman", $pengalamanSelectSinkron)
                    ->delete();

                foreach ($pengalamanSelectSinkron as $data) {
                    DB::table("gabung_matakuliah_pengalaman_sinkron")->updateOrInsert(
                        [
                            "kdmatakuliah" => $mkSubBk->kdmatakuliah,
                            "id_pengalaman" => $data,
                            "kdtahunakademik" => $kdTahunAkademim
                        ],
                        // Optional: You can add other columns to update if needed
                        []
                    );
                }
            }



            // Asinkron
            if (count($pengalamanSelectAsinkron) > 0) {
                DB::table("gabung_matakuliah_pengalaman_asinkron")
                    ->where("kdmatakuliah", $mkSubBk->kdmatakuliah)
                    ->where("kdtahunakademik", $kdTahunAkademim)
                    ->whereNotIn("id_pengalaman", $pengalamanSelectAsinkron)
                    ->delete();

                foreach ($pengalamanSelectAsinkron as $data) {
                    DB::table("gabung_matakuliah_pengalaman_asinkron")->updateOrInsert(
                        [
                            "kdmatakuliah" => $mkSubBk->kdmatakuliah,
                            "id_pengalaman" => $data,
                            "kdtahunakademik" => $kdTahunAkademim
                        ],
                        // Optional: You can add other columns to update if needed
                        []
                    );
                }
            }


            DB::commit();
            return back();
        } catch (Throwable $th) {
            DB::rollBack();

            return dd($th);
        }
    }

    public function detailReferensiStore(Request $request, int $id)
    {
        $filter = ak_tahunakademik::where("isaktif", 1)->orderBy("kdtahunakademik", "desc")->first();

        $kdTahunAkademim = $request->has("filter-form") ? $request->input('filter-form') : $filter->kdtahunakademik;

        try {
            // DB::transaction();

            // ============================== Referensi Start ====================================

            if ($request->input("referensi_utama") != '' || $request->input("referensi_utama") != null) {

                foreach ($request->input("referensi_utama") as $inputUtama) {
                    $referensiUtama = ak_referensi::create([
                        'referensi'  => $inputUtama,
                        'jenis'  => 'utama',
                    ]);
                    // dd($referensiUtama, 'masuk');
                    $dataUtama = DB::table('ak_matakuliah_referensi_utama')->insert([
                        "kdmatakuliah" => $id,
                        "id_referensi" => $referensiUtama->kdreferensi,
                        "kdtahunakademik" => $kdTahunAkademim
                    ]);
                }
            }


            if ($request->input("referensi_tambahan") != '' || $request->input("referensi_tambahan") != null) {
                foreach ($request->input("referensi_tambahan") as $inputTambahan) {
                    $referensiTambahan = ak_referensi::create([
                        'referensi'  => $inputTambahan,
                        'jenis'  => 'tambahan'
                    ]);

                    $dataTambahan = DB::table('ak_matakuliah_referensi_tambahan')->insert([
                        "kdmatakuliah" => $id,
                        "id_referensi" => $referensiTambahan->kdreferensi,
                        "kdtahunakademik" => $kdTahunAkademim

                    ]);
                }
            }

            if ($request->input("refrensi_luaran") != '' || $request->input("referensi_luaran") != null) {
                foreach ($request->input("referensi_luaran") as $inputLuaran) {
                    $referensiLuaran = ak_referensi::create([
                        'referensi' => $inputLuaran,
                        'jenis' => 'luaran'
                    ]);

                    $dataluaran = DB::table('ak_matakuliah_referensi_luaran')->insert([
                        "kdmatakuliah" => $id,
                        "id_referensi" => $referensiLuaran->kdreferensi,
                        "kdtahunakademik" => $kdTahunAkademim

                    ]);
                }
            }
            // =========================== REFERENSI END =============================


            // DB::commit();
            return back();
        } catch (Throwable $th) {
            DB::rollback();

            return dd($th);
        }
    }

    public function deletePengalamanSinkron(int $id)
    {
        $pengalamanSinkron = gabung_matakuliah_pengalaman_sinkron::findOrFail($id);

        if (!$pengalamanSinkron) {
            return abort(404);
        }

        $pengalamanSinkron->delete();

        return redirect()->back()->with('success', 'sukses hapus');
    }

    public function deletePengalamanAsinkron(int $id)
    {
        $pengalamanAsinkron = gabung_matakuliah_pengalaman_asinkron::findOrFail($id);

        if (!$pengalamanAsinkron) {
            return abort(404);
        }

        $pengalamanAsinkron->delete();

        return redirect()->back()->with('success', 'sukses hapus');
    }

    public function deleteReferensiUtama(int $id)
    {

        $referensiUtama = ak_matakuliah_referensi_utama::findOrFail($id);
        if (!$referensiUtama) {
            return abort(404);
        }

        $referensiUtama->delete();


        return redirect()->back()->with('success', 'sukses hapus');
    }

    public function deleteReferensiTambahan(int $id)
    {
        $referensiTambahan = ak_matakuliah_referensi_tambahan::findOrFail($id);

        if (!$referensiTambahan) {
            return abort(404);
        }

        $referensiTambahan->delete();



        return redirect()->back()->with('success', 'sukses hapus');
    }

    public function deleteReferensiLuaran(int $id)
    {
        $referensiLuaran = ak_matakuliah_referensi_luaran::findOrFail($id);

        if (!$referensiLuaran) {
            return abort(404);
        }

        $referensiLuaran->delete();



        return redirect()->back()->with('success', 'sukses hapus');
    }

    // Belum dipakai
    // mapping metode pembelajaran index
    public function kelolaPembelajaran(int $id)
    {

        $metodePembelajaran = ak_metodepembelajaran::all();

        $cmpkPembelajaran = gabung_subbk_cpmk::where('id', '=', $id)->with('pembelajaran')->first();

        $pembelajaranSelected = [];
        foreach ($cmpkPembelajaran->pembelajaran as $item) {
            array_push($pembelajaranSelected, $item->id);
        }

        return view('pages.matakuliah.pembelajaran', compact('id', 'pembelajaran', 'pembelajaranSelected'));
    }

    // POST mapping metode pembelajaran index
    public function postKelolaPembelajaran(Request $request, int $id)
    {
        $pembelajaranSelect = [];
        // validasi
        if ($request->has("pembelajaran")) {
            foreach ($request->input("pembelajaran") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($pembelajaranSelect, $value);
                }
            }
        }

        try {
            $pembelajaran = gabung_subbk_cpmk::where('id', '=', $id)->with('pembelajaran')->first();
            DB::beginTransaction();
            if (count($pembelajaranSelect) > 0) {
                $pembelajaran->pembelajaran()->sync($pembelajaranSelect);
            } else {
                $pembelajaran->pembelajaran()->detach();
            }
            DB::commit();
            return redirect()->back()->with("success", "sukses update Metode Pembelajaran");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with("failed", "gagal update" . $th->getMessage());
        }
    }

    public function pdfGet()
    {
        $data = ['title' => 'testing PDF'];
        $pdf = Pdf::loadView('matakuliah.rps', $data);
        return $pdf->download('rps.pdf');
    }
}
