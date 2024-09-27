<?php

namespace App\Http\Controllers;

use App\Exports\ExportNilai;
use App\Imports\ImportNilai;
use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_cpmk;
use App\Models\ak_penilaian;
use App\Models\exportNilaiModel;
use App\Models\gabung_metopen_cpmk;
use App\Models\gabung_mk_cpmk;
use App\Models\gabung_nilai_metopen;
use App\Models\gabung_subbk_cpmk;
use App\Models\metode_penilaian;
use App\Models\PenilaianFileUpload;
use App\Models\v_persenplo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class metodePenilaianController extends Controller
{
    // index 

    public function index(Request $request)
    {

        if (auth()->user()->kdunit == 42) {

            $matakuliah = ak_matakuliah::select("simptt.ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
                ->leftJoin("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
                ->leftJoin("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
                ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
                ->leftJoin("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->where("ak_kurikulum.isObe", '=', 1)
                ->join('simptt.ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'simptt.ak_matakuliah.kdkurikulum')
                ->distinct();

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $tipeLensa = DB::table('tipelensa')->get();

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 3) {
            $matakuliah = ak_matakuliah::select("simptt.ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
                ->leftJoin("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
                ->leftJoin("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
                ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
                ->leftJoin("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->where("ak_kurikulum.isObe", '=', 1)
                ->join('simptt.ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'simptt.ak_matakuliah.kdkurikulum')
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->distinct();

            $tipeLensa = DB::table('tipelensa')->get();

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 2) {
            $matakuliah = ak_matakuliah::select("simptt.ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
                ->leftJoin("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
                ->leftJoin("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
                ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
                ->leftJoin("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->where("ak_kurikulum.isObe", '=', 1)
                ->join('simptt.ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'simptt.ak_matakuliah.kdkurikulum')
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where('ak_kurikulum.kdkurikulum', 67)
                ->distinct();

            $tipeLensa = DB::table('tipelensa')->get();

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where('ak_kurikulum.kdkurikulum', 67)
                ->where("isObe", "=", 1)
                ->get();
        } else {

            $mk = ak_matakuliah::toSql();
            // dd($mk);

            $matakuliah = ak_matakuliah::select("simptt.ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
                ->leftJoin("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
                ->leftJoin("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
                ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
                ->leftJoin("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->where("ak_kurikulum.isObe", '=', 1)
                ->join('simptt.ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'simptt.ak_matakuliah.kdkurikulum')
                ->distinct()
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->orderBy("kdmatakuliah");

            $tipeLensa = DB::table('tipelensa')->get();

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();
        }


        $matakuliah = $matakuliah
            ->when($request->input('filter-matakuliah') != '' || $request->input('filter-matakuliah') != null, function ($query) use ($request) {
                $query->where('matakuliah', 'like', "%" . $request->input("filter-matakuliah") . "%");
            })
            ->when($request->input('filter-kurikulum') != null || $request->input('filter-kurikulum') != '', function ($query) use ($request) {
                $query->where("simptt.ak_matakuliah.kdkurikulum", $request->input('filter-kurikulum'));
            })
            ->paginate(10);

        // dd($mk);

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }


        return view('pages.metopen.index', compact('matakuliah', 'kdkurikulum', 'tahunAkademik', 'tipeLensa'));
    }

    public function postIndex(Request $request)
    {
        $request->validate([
            'id_gabung' => ['required', 'numeric'],
            'bobot' => ['nullable', 'numeric']
        ]);

        // return dd($request->all());

        try {
            $mtp = gabung_metopen_cpmk::findOrFail($request->input("id_gabung"));

            DB::beginTransaction();

            $mtp->bobot = $request->input('bobot');

            $mtp->save();

            DB::commit();

            return redirect()->back()->with('success', 'berhasil menambah bobot nilai');
        } catch (Throwable $th) {
            return redirect()->back()->with('failed', 'gagal menambah bobot nilai. Error: ' . $th->getMessage());
        }
    }

    public function metodePenilaian()
    {
        $metopen = DB::table('metode_penilaians')
            ->select('metode_penilaians.*')
            ->paginate(10);

        return view('pages.metopen.metodePenilaian', compact('metopen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_penilaian'
        ]);

        metode_penilaian::create([
            'metode_penilaian' => $request->metode_penilaian
        ]);

        return redirect()->route('metopen')->with('success', 'Metode Penilaian Berhasil ditambah');
    }

    public function delete(int $id)
    {
        $metopen = metode_penilaian::findOrFail($id);



        // return dd($pl);

        $metopen->delete();
        return redirect(url()->previous())->with('success', 'Metode Penilaian berhasil dihapus');
    }


    public function kelolaMetopen(int $id, Request $request)
    {

        $redirect_url = $request->input('redirect_url', route('index.metopen')); // Default to index if not provided


        // metode penilaian
        $metopen = metode_penilaian::with('MTPtoCPMK')->get();
        $gabung_mk_cpmk = gabung_mk_cpmk::with('CPMKtoMTP')->findOrFail($id);

        $id_metopen = [];
        foreach ($gabung_mk_cpmk->CPMKtoMTP as $data) {
            $id_metopen[] = $data->id;
        }

        return view('pages.metopen.metopen', compact('id_metopen', 'metopen', 'redirect_url'));
    }

    public function postKelolaMetopen(int $id, Request $request)
    {
        // dd($id);

        $redirect_url = $request->input('redirect_url', route('index.metopen'));

        $metopenSelect = [];
        if ($request->has('metopenSelect')) {
            foreach ($request->input("metopenSelect") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($metopenSelect, $value);
                }
            }
        }

        // return dd($metopenSelect);

        try {
            // $metopenCPMK = gabung_subbk_cpmk::where('id_cpmk', '=', $id)->with('CPMKtoMTP')->first();

            $gabung_mk_cpmk = gabung_mk_cpmk::with('CPMKtoMTP')->findOrFail($id);
            DB::beginTransaction();

            if (count($metopenSelect) > 0) {

                $gabung_mk_cpmk->CPMKtoMTP()->sync($metopenSelect);
            } else {
                $gabung_mk_cpmk->CPMKtoMTP()->detach();
            }

            DB::commit();
            // return dd($metopenCPMK, "success");
            // return redirect()->back()->with("success", "berhasil update Metode Penilaian pada CPMK");
            return redirect($redirect_url)->with("success", "berhasil update Metode Penilaian pada CPMK");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("failed", "gagal update" . $th->getMessage());
        }
    }

    public function tugasIndex(int $id)
    {

        $gmc = gabung_metopen_cpmk::select("kode_cpmk", "cpmk", "metode_penilaian", "bobot")
            ->join("gabung_subbk_cpmks as gsc", "gsc.id", "=", "gabung_metopen_cpmks.id_gabung_cpmk")
            ->join("ak_kurikulum_cpmks as kc", "kc.id", "=", "gsc.id_cpmk")
            ->join("metode_penilaians as mp", "mp.id", "=", "gabung_metopen_cpmks.id_metopen")
            ->findOrFail($id);

        $gsc = DB::table("gabung_subbk_cpmks as gsc")
            ->select("kode_cpmk", "cpmk", "metode_penilaian")
            ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "gsc.id")
            ->join("ak_kurikulum_cpmks as kc", "kc.id", "=", "gsc.id_cpmk")
            ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
            ->get();



        return view('pages.metopen.tugas', compact('gmc', 'gsc'));
    }

    public function tugasPost(Request $request)
    {
        $request->validate([
            'keterangan'
        ]);

        // DB::select('call sistem_obe.copy_mhs(?,?)', [$request->kdmatakuliah, $request->gnmid]);

        gabung_nilai_metopen::create([
            'id_gabung_metopen' => $request->tgsinput_id,
            'keterangan' => $request->keterangan,
            'kdtahunakademik' => $request->tahunakademik,
            'idlensa' => $request->idlensa,
            'idtipelensa' => $request->idtipelensa

        ]);


        // $test = gabung_nilai_metopen::create([
        //     'id_gabung_metopen' => $request->tgsinput_id,
        //     'keterangan' => $request->keterangan,
        //     'kdtahunakademik' => $request->tahunakademik

        // ]);

        // $test->id;

        // dd($test->id);

        return redirect()->back()->with('success', 'keterangan metode penilaian berhasil ditambah');
    }

    public function checkData($gmcId)
    {
        $exists = gabung_nilai_metopen::where('id_gabung_metopen', $gmcId)->exists();
        return response()->json(['exists' => $exists]);
    }


    public function listNilai(int $id, Request $request)
    {

        $list = gabung_nilai_metopen::select("kode_cpmk", "metode_penilaian", "gabung_nilai_metopen.keterangan", "bobot", "gabung_nilai_metopen.kdjenisnilai as kjn", "mk.kdmatakuliah as mkd", "mk.matakuliah", "gabung_nilai_metopen.kdtahunakademik")
            ->where("id_gabung_metopen", '=', $id)
            ->join('gabung_metopen_cpmks as gmc', 'gmc.id', '=', 'gabung_nilai_metopen.id_gabung_metopen')
            ->join("ak_matakuliah_cpmk as amc", "amc.id", "=", "gmc.id_gabung_cpmk")
            ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "amc.kdmatakuliah")
            ->join("ak_kurikulum_cpmks as akc", "akc.id", "=", "amc.id_cpmk")
            ->join('metode_penilaians as mp', 'mp.id', '=', 'gmc.id_metopen')
            ->join("ak_tahunakademik as ata", "ata.kdtahunakademik", "=", "gabung_nilai_metopen.kdtahunakademik")
            ->first();


        $listNilai = gabung_nilai_metopen::select("kode_cpmk", "metode_penilaian", "gabung_nilai_metopen.keterangan", "bobot", "gabung_nilai_metopen.kdjenisnilai as kjn", "mk.kdmatakuliah as mkd", "gabung_nilai_metopen.kdtahunakademik", "tahunakademik", "idlensa", "tl.tipelensa", "url")
            ->where("id_gabung_metopen", '=', $id)
            ->join('gabung_metopen_cpmks as gmc', 'gmc.id', '=', 'gabung_nilai_metopen.id_gabung_metopen')
            ->join("ak_matakuliah_cpmk as amc", "amc.id", "=", "gmc.id_gabung_cpmk")
            ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "amc.kdmatakuliah")
            ->join("ak_kurikulum_cpmks as akc", "akc.id", "=", "amc.id_cpmk")
            ->join('metode_penilaians as mp', 'mp.id', '=', 'gmc.id_metopen')
            ->leftJoin("tipelensa as tl", "tl.id", "=", "gabung_nilai_metopen.idtipelensa")
            ->join("ak_tahunakademik as ata", "ata.kdtahunakademik", "=", "gabung_nilai_metopen.kdtahunakademik")
            ->paginate(15);
        // ->first();

        $tipeLensa = DB::table('tipelensa')->get();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();

        $arrayTahun = [];
        foreach ($tahunAkademik as $data) {
            array_push($arrayTahun, $data->kdtahunakademik);
        }

        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayTahun)) {
                $listNilai = gabung_nilai_metopen::select("kode_cpmk", "metode_penilaian", "gabung_nilai_metopen.keterangan", "bobot", "gabung_nilai_metopen.kdjenisnilai as kjn", "mk.kdmatakuliah as mkd", "tahunakademik", "gabung_nilai_metopen.kdtahunakademik")
                    ->where("id_gabung_metopen", '=', $id)
                    ->join('gabung_metopen_cpmks as gmc', 'gmc.id', '=', 'gabung_nilai_metopen.id_gabung_metopen')
                    ->join("ak_matakuliah_cpmk as amc", "amc.id", "=", "gmc.id_gabung_cpmk")
                    ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "amc.kdmatakuliah")
                    ->join("ak_kurikulum_cpmks as akc", "akc.id", "=", "amc.id_cpmk")
                    ->join("ak_tahunakademik as ata", "ata.kdtahunakademik", "=", "gabung_nilai_metopen.kdtahunakademik")
                    ->join('metode_penilaians as mp', 'mp.id', '=', 'gmc.id_metopen')
                    ->where("gabung_nilai_metopen.kdtahunakademik", "=", $request->filter)
                    ->paginate(15);
            }
        }


        // dd($listNilai);
        return view('pages.metopen.list', compact('listNilai', 'tahunAkademik', 'list', 'tipeLensa'));
    }

    public function listNilaiUpdate(Request $request)
    {

        try {

            $listUpdate = gabung_nilai_metopen::findOrFail($request->input("kdjenisnilai_"));

            $listUpdate->update([
                "keterangan" => $request->keterangan,
                "kdtahunakademik" => $request->tahunakademik,
                "idlensa" => $request->idlensa,
                "idtipelensa" => $request->idtipelensa
            ]);


            return redirect()->back();
        } catch (Throwable $th) {
            DB::rollBack();
            // dd($th->getMessage());

            return redirect()->back();
        }
    }

    public function listNilaiDelete(int $kdjenisnilai)
    {
        DB::table('gabung_nilai_metopen')->where("kdjenisnilai", $kdjenisnilai)->delete();

        return redirect()->back()->with('success', 'berhasil hapus list');
    }

    public function listNilaiPost(Request $request)
    {
        DB::select('call sistem_obe.kopi_mhs(?,?,?,?)', [$request->kdmatakuliah_, $request->kdtahunakademik_, $request->kelas_, $request->kdjenisnilai_]);
        // dd($listNilaiPost, "masuk");
        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambah');
    }

    public function ambilNilai(Request $request, int $id)
    {
        DB::select('call sistem_obe.isinilai_dari_lensa(?)', [$id]);

        return redirect()->back()->with('success', "Nilai Berhasil Di-Ambil");
    }

    public function penilaian(int $id, string $kdtahunakademik)
    {

        // dd('test');

        $kelas = ak_penilaian::select("ak_penilaian.nilai as apnilai", "ak_penilaian.id as kdpen", "gnm.kdjenisnilai as kdjn", "nim", "namalengkap", "matakuliah", "gnm.keterangan as keterangan", "kode_cpmk", "cpmk", "pmk.kelas as kelas", "gmc.bobot as bobot", "gmc.id as gmcid", "metode_penilaian", "mk.batasNilai as batas_nilai")
            ->join("ak_krsnilai as krs", "krs.kdkrsnilai", "=", "ak_penilaian.kdkrsnilai")
            ->join("ak_penawaranmatakuliah as pmk", "pmk.kdpenawaran", "=", "krs.kdpenawaran")
            ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "pmk.kdmatakuliah")
            ->join("ak_mahasiswa as mhs", "mhs.kdmahasiswa", "=", "krs.kdmahasiswa")
            ->join("pt_person as per", "per.kdperson", "=", "mhs.kdperson")
            ->join("gabung_nilai_metopen as gnm", "gnm.kdjenisnilai", "=", "ak_penilaian.kdjenisnilai")
            ->join("gabung_metopen_cpmks as gmc", "gmc.id", "=", "gnm.id_gabung_metopen")
            ->join("ak_matakuliah_cpmk as amc", "amc.id", "=", "gmc.id_gabung_cpmk")
            ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "amc.id_cpmk")
            ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
            ->where("krs.kdtahunakademik", "=", $kdtahunakademik)
            ->where("gnm.kdjenisnilai", "=", $id)
            ->first();

        $penilaian = ak_penilaian::select("ak_penilaian.nilai as apnilai", "ak_penilaian.id as kdpen", "gnm.kdjenisnilai as kdjn", "nim", "namalengkap", "ak_penilaian.kdkrsnilai", "path_laporan", "path_foto")
            ->join("ak_krsnilai as krs", "krs.kdkrsnilai", "=", "ak_penilaian.kdkrsnilai")
            ->join("ak_mahasiswa as mhs", "mhs.kdmahasiswa", "=", "krs.kdmahasiswa")
            ->join("pt_person as per", "per.kdperson", "=", "mhs.kdperson")
            ->join("gabung_nilai_metopen as gnm", "gnm.kdjenisnilai", "=", "ak_penilaian.kdjenisnilai")
            ->where("gnm.kdjenisnilai", "=", $id)
            ->where("krs.kdtahunakademik", "=", $kdtahunakademik)
            ->orderby('nim')
            ->get();
        // ->toSql();

        $viewnilai = exportNilaiModel::where("kdjenisnilai", "=", $id);

        $rubik = PenilaianFileUpload::where(["jenisNilai_id" => $id, 'tahunAkademik_id' => $kdtahunakademik])->get();

        // dd($penilaian);

        return view('pages.metopen.tugas', compact('penilaian', 'kelas', 'id', 'kdtahunakademik', 'rubik'));
    }

    public function penilaianUploadPost(Request $request, $id, $tahun)
    {
        $request->validate([
            'file' => ["required", "max:2000"]
        ]);

        try {
            $folder = rand();

            $file = \Illuminate\Support\Str::random() . '-' . $request->file('file')->getClientOriginalName();

            // save to db
            PenilaianFileUpload::create([
                'folder' => $folder,
                'file' => $file,
                'jenisNilai_id' => $id,
                'tahunAkademik_id' => $tahun
            ]);

            Storage::putFileAs("public/rubik/", $request->file('file'), $file);

            return redirect(url()->previous())->with('success', 'rubik berhasil di up');
        } catch (Throwable $th) {
            dd($th->getMessage());
        }
        return dd($request->all(), $id, $tahun);
    }

    public function penilaianUploadDelete($id, $tahun, $id_file)
    {
        $file = PenilaianFileUpload::findOrFail($id_file);

        Storage::deleteDirectory("public/rubik/" . $file->folder);

        $file->delete();

        return redirect(url()->previous())->with('success', 'berhasil hapus');
    }

    public function postPenilaian(Request $request)
    {
        $request->validate([
            'nilai' => ['required', 'numeric']
        ]);

        try {
            DB::beginTransaction();

            $nilai = ak_penilaian::findOrFail($request->input("kdpenilaian"));
            $nilai->update(['nilai' => $request->input('nilai')]);

            DB::commit();

            return response()->json(['success' => true]);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }

    public function finalNilai(int $id, Request $request)
    {

        // dd($request->filter);

        $matakuliah = ak_matakuliah::select("matakuliah", "batasNilai", "namalengkap", "gelarbelakang")
            ->join("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
            ->join("ak_penawaranmatakuliah as pmk", "pmk.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
            ->join("ak_timteaching as att", "att.kdpenawaran", "=", "pmk.kdpenawaran")
            ->join("pt_person as per", "per.kdperson", "=", "att.kdperson")
            ->where('simptt.ak_matakuliah.kdmatakuliah', "=", $id)
            ->first();

        $cpl = ak_matakuliah::select("kode_cpl")
            ->join("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
            ->join("ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk", "cplcpmk.ak_kurikulum_cpmk_id", "=", "amc.id_cpmk")
            ->join("ak_kurikulum_cpls as akc", "akc.id", "=", "cplcpmk.ak_kurikulum_cpl_id")
            ->join("ak_penawaranmatakuliah as pmk", "pmk.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
            ->join("ak_timteaching as att", "att.kdpenawaran", "=", "pmk.kdpenawaran")
            ->join("pt_person as per", "per.kdperson", "=", "att.kdperson")
            ->where('simptt.ak_matakuliah.kdmatakuliah', "=", $id)
            ->where('pmk.kdtahunakademik', "=", 20231)
            ->distinct()
            ->get();

        $test = ak_matakuliah::select("simptt.ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian")
            ->join("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "simptt.ak_matakuliah.kdmatakuliah")
            ->join("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
            ->join("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
            ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
            ->join("gabung_nilai_metopen as gnm", "gnm.id_gabung_metopen", "=", "gmc.id")
            ->join("ak_penilaian as ap", "ap.kdjenisnilai", "=", "gnm.kdjenisnilai")
            ->join('simptt.ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'simptt.ak_matakuliah.kdkurikulum')
            ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
            ->where("simptt.ak_matakuliah.kdmatakuliah", "=", $id)
            ->where("ak_kurikulum.isObe", '=', 1)
            ->distinct()
            ->get();


        $tabel = ak_matakuliah_cpmk::select("gmc.id", "metode_penilaian", "bobot", "kode_cpmk", "kode_cpl")
            ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_cpmk.kdmatakuliah")
            ->join("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "ak_matakuliah_cpmk.id")
            ->join("gabung_nilai_metopen as gnm", "gnm.id_gabung_metopen", "=", "gmc.id")
            ->join("ak_penilaian as ap", "ap.kdjenisnilai", "=", "gnm.kdjenisnilai")
            ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
            ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "ak_matakuliah_cpmk.id_cpmk")
            ->join("ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk", "cplcpmk.ak_kurikulum_cpmk_id", "=", "ak_matakuliah_cpmk.id_cpmk")
            ->join("ak_kurikulum_cpls as akc", "akc.id", "=", "cplcpmk.ak_kurikulum_cpl_id")
            ->where("mk.kdmatakuliah", "=", $id)
            ->orderBy('gmc.id')
            ->distinct()
            ->get();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();


        $arrayTahun = [];
        foreach ($tahunAkademik as $data) {
            array_push($arrayTahun, $data->kdtahunakademik);
        }



        $tabularNilai = DB::select('call sistem_obe.nilai_tabular(?,?)', [$id, $request->filter]);
        $nilai = json_decode(json_encode($tabularNilai), true);
        foreach ($nilai as $key => $value) {
            $loop = 1;
            foreach ($value as $urutanData => $data) {
                if ($loop <= 5) {
                    $mahasiswa[$key][] = $data;
                } else {
                    $mahasiswa[$key][5][$urutanData] = $data;
                }
                $loop++;
            }
        }

        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayTahun)) {
                $tabularNilai = DB::select('call sistem_obe.nilai_tabular(?,?)', [$id, $request->filter]);
            }
        }

        $persentaseLulus = DB::select('call sistem_obe.total_lulus(?)', [$id]);
        foreach ($persentaseLulus as $key => $item) {
            foreach ($item as $KY => $keys) {
                $nilaiAkhir[] = $keys;
            }
        }

        // CPL

        $plo = DB::select('call sistem_obe.persenplo(?,?)', [$id, $request->filter]);

        $plofinal = json_decode(json_encode($plo), true);

        // CPMK

        $cpmk = DB::select('call sistem_obe.persencpmk(?,?)', [$id, $request->filter]);
        $cpmkfinal = json_decode(json_encode($cpmk), true);

        // dd($cpmkfinal);


        $persenplo = DB::table('v_persenplo')->where("kdmatakuliah", "=", $id)->get();

        $kelulusanpermahasiswa = [];
        foreach ($persenplo as $key => $value) {
            $kelulusanpermahasiswa[$value->kdkrsnilai] = (array_key_exists($value->kdkrsnilai, $kelulusanpermahasiswa) ? $kelulusanpermahasiswa[$value->kdkrsnilai] : 1) && $value->statuslulus;
        }



        return view('pages.metopen.final', compact('tahunAkademik', 'mahasiswa', 'tabel', 'matakuliah', 'cpl', 'persentaseLulus', 'persenplo', 'kelulusanpermahasiswa', 'cpmkfinal'));
    }



    public function exportNilai($id, $kdtahunakademik)
    {

        $kelas = ak_penilaian::select("ak_penilaian.nilai as apnilai", "ak_penilaian.id as kdpen", "gnm.kdjenisnilai as kdjn", "nim", "namalengkap", "matakuliah", "gnm.keterangan as keterangan", "kode_cpmk", "cpmk", "pmk.kelas as kelas", "gmc.bobot as bobot", "gmc.id as gmcid", "metode_penilaian", "mk.batasNilai as batas_nilai")
            ->join("ak_krsnilai as krs", "krs.kdkrsnilai", "=", "ak_penilaian.kdkrsnilai")
            ->join("ak_penawaranmatakuliah as pmk", "pmk.kdpenawaran", "=", "krs.kdpenawaran")
            ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "pmk.kdmatakuliah")
            ->join("ak_mahasiswa as mhs", "mhs.kdmahasiswa", "=", "krs.kdmahasiswa")
            ->join("pt_person as per", "per.kdperson", "=", "mhs.kdperson")
            ->join("gabung_nilai_metopen as gnm", "gnm.kdjenisnilai", "=", "ak_penilaian.kdjenisnilai")
            ->join("gabung_metopen_cpmks as gmc", "gmc.id", "=", "gnm.id_gabung_metopen")
            ->join("ak_matakuliah_cpmk as amc", "amc.id", "=", "gmc.id_gabung_cpmk")
            ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "amc.id_cpmk")
            ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
            ->where("gnm.kdjenisnilai", "=", $id)
            ->where("gnm.kdtahunakademik", "=", $kdtahunakademik)
            ->first();
        // return Excel::download(new ExportNilai, "nilai.xlsx");

        return (new ExportNilai($id))->download($kelas->matakuliah . " " . $kelas->keterangan . " " . Carbon::now()->timestamp . '.xlsx');
    }

    public function importNilai(Request $request, $id)
    {
        // dd($request->file('file'));

        Excel::import(new ImportNilai, $request->file('file'));

        return redirect()->back();
    }
}
