<?php

namespace App\Http\Controllers;

use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_cpmk;
use App\Models\ak_penilaian;
use App\Models\gabung_metopen_cpmk;
use App\Models\gabung_mk_cpmk;
use App\Models\gabung_nilai_metopen;
use App\Models\gabung_subbk_cpmk;
use App\Models\metode_penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class metodePenilaianController extends Controller
{
    // index 

    public function index(Request $request)
    {

        if (auth()->user()->kdunit == 100 || auth()->user()->kdunit == 0) {
            // $matakuliah = ak_matakuliah::with("GetAllidSubBK.cpmks.metopens.CPMKtoMTP")
            //     ->where("isObe", '=', 1)
            //     ->orderBy('kdmatakuliah', 'asc')
            //     ->paginate(10);

            $matakuliah = ak_matakuliah::select("ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
                ->leftJoin("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
                ->leftJoin("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
                ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
                ->leftJoin("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->where("ak_kurikulum.isObe", '=', 1)
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->distinct()

                ->paginate(15);

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 3) {
            $matakuliah = ak_matakuliah::select("ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
                ->leftJoin("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
                ->leftJoin("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
                ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
                ->leftJoin("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->where("ak_kurikulum.isObe", '=', 1)
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->distinct()
                ->paginate(15);

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $kdkurikulum = DB::table("ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->where("isObe", "=", 1)
                ->get();
        } else {
            $matakuliah = ak_matakuliah::select("ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
                ->leftJoin("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
                ->leftJoin("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
                ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
                ->leftJoin("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->where("ak_kurikulum.isObe", '=', 1)
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->distinct()
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->orderBy("kdmatakuliah")
                ->paginate(15);

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();
        }

        // dd($matakuliah);

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }


        // searching belum disamakan dengan metode kd unit
        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                // $matakuliah = ak_matakuliah::with('MKtoSub_bk.SBKtoidCPMK', 'MKtoSub_bk.getSBKtoidCPMK', 'GetAllidSubBK')
                //     ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                //     ->where("ak_kurikulum.isObe", '=', 1)
                //     ->where("kurikulum", "=", $request->filter)
                //     ->orderBy('kdmatakuliah', 'asc')
                //     ->paginate(10);


                $matakuliah = ak_matakuliah::select("ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
                    ->leftJoin("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
                    ->leftJoin("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
                    ->leftJoin("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
                    ->leftJoin("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                    ->where("ak_kurikulum.isObe", '=', 1)
                    ->distinct()
                    ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                    ->where("kurikulum", "=", $request->filter)
                    ->paginate(15);
            }
        }


        // $matakuliah->each(function ($data) {
        //     $cpmks = [];
        //     foreach ($data->GetAllidSubBK as $key => $value) {
        //         $cpmk = [];
        //         foreach ($value->cpmks as $item) {
        //             $cpmk[] = [$item->pivot->id, $item->kode_cpmk];
        //         }
        //         $cpmks[] = $cpmk;
        //     }
        //     $data->cpmks = $cpmks;
        // });


        return view('pages.metopen.index', compact('matakuliah', 'kdkurikulum', 'tahunAkademik'));
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


    public function kelolaMetopen(int $id)
    {

        // metode penilaian
        $metopen = metode_penilaian::with('MTPtoCPMK')->get();
        $gabung_mk_cpmk = gabung_mk_cpmk::with('CPMKtoMTP')->findOrFail($id);

        $id_metopen = [];
        foreach ($gabung_mk_cpmk->CPMKtoMTP as $data) {
            $id_metopen[] = $data->id;
        }

        return view('pages.metopen.metopen', compact('id_metopen', 'metopen'));
    }

    public function postKelolaMetopen(int $id, Request $request)
    {
        // dd($id);

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
            return redirect()->back()->with("success", "berhasil update Metode Penilaian pada CPMK");
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
            'kdtahunakademik' => $request->tahunakademik

        ]);


        // $test = gabung_nilai_metopen::create([
        //     'id_gabung_metopen' => $request->tgsinput_id,
        //     'keterangan' => $request->keterangan,
        //     'kdtahunakademik' => $request->tahunakademik

        // ]);

        // $test->id;

        // dd($test->id);

        return redirect()->route('index.metopen')->with('success', 'keterangan metode penilaian berhasil ditambah');
    }


    public function listNilai(int $id)
    {




        $list = gabung_nilai_metopen::select("kode_cpmk", "metode_penilaian", "gabung_nilai_metopen.keterangan", "bobot", "gabung_nilai_metopen.kdjenisnilai as kjn", "mk.kdmatakuliah as mkd", "mk.matakuliah")
            ->where("id_gabung_metopen", '=', $id)
            ->join('gabung_metopen_cpmks as gmc', 'gmc.id', '=', 'gabung_nilai_metopen.id_gabung_metopen')
            ->join("ak_matakuliah_cpmk as amc", "amc.id", "=", "gmc.id_gabung_cpmk")
            ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "amc.kdmatakuliah")
            ->join("ak_kurikulum_cpmks as akc", "akc.id", "=", "amc.id_cpmk")
            ->join('metode_penilaians as mp', 'mp.id', '=', 'gmc.id_metopen')
            ->first();


        $listNilai = gabung_nilai_metopen::select("kode_cpmk", "metode_penilaian", "gabung_nilai_metopen.keterangan", "bobot", "gabung_nilai_metopen.kdjenisnilai as kjn", "mk.kdmatakuliah as mkd")
            ->where("id_gabung_metopen", '=', $id)
            ->join('gabung_metopen_cpmks as gmc', 'gmc.id', '=', 'gabung_nilai_metopen.id_gabung_metopen')
            ->join("ak_matakuliah_cpmk as amc", "amc.id", "=", "gmc.id_gabung_cpmk")
            ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "amc.kdmatakuliah")
            ->join("ak_kurikulum_cpmks as akc", "akc.id", "=", "amc.id_cpmk")
            ->join('metode_penilaians as mp', 'mp.id', '=', 'gmc.id_metopen')
            ->paginate(15);

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();


        // dd($listNilai);
        return view('pages.metopen.list', compact('listNilai', 'tahunAkademik', 'list'));
    }

    public function listNilaiPost(Request $request)
    {
        DB::select('call sistem_obe.kopi_mhs(?,?,?,?)', [$request->kdmatakuliah_, $request->kdtahunakademik_, $request->kelas_, $request->kdjenisnilai_]);
        // dd($listNilaiPost, "masuk");
        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambah');
    }

    public function penilaian(int $id)
    {

        // dd('test');

        $kelas = ak_penilaian::select("ak_penilaian.nilai as apnilai", "ak_penilaian.id as kdpen", "gnm.kdjenisnilai as kdjn", "nim", "namalengkap", "matakuliah", "gnm.keterangan as keterangan", "kode_cpmk", "cpmk", "pmk.kelas as kelas", "gmc.bobot as bobot", "gmc.id as gmcid", "metode_penilaian", "mk.batasNilai as batas_nilai")
            ->join("ak_krsnilai as krs", "krs.kdkrsnilai", "=", "ak_penilaian.kdkrsnilai")
            ->join("ak_penawaranmatakuliah as pmk", "pmk.kdpenawaran", "=", "krs.kdpenawaran")
            ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "pmk.kdmatakuliah")
            ->join("ak_mahasiswa as mhs", "mhs.kdmahasiswa", "=", "krs.kdmahasiswa")
            ->join("pt_person as per", "per.kdperson", "=", "mhs.kdperson")
            ->join("gabung_nilai_metopen as gnm", "gnm.kdjenisnilai", "=", "ak_penilaian.kdjenisnilai")
            ->join("gabung_metopen_cpmks as gmc", "gmc.id", "=", "gnm.id_gabung_metopen")
            ->join("ak_matakuliah_cpmk as amc", "amc.id", "=", "gmc.id_gabung_cpmk")
            ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "amc.id_cpmk")
            ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
            ->where("gnm.kdjenisnilai", "=", $id)
            ->first();
        // ->all();
        // ->paginate(10);

        // dd($kelas);

        // $test = DB::raw("select p.id , mhs.nim , per.namalengkap, p.nilai
        // from ak_penilaian p 
        // straight_join ak_krsnilai krs on krs.kdkrsnilai = p.kdkrsnilai
        // straight_join ak_mahasiswa mhs on mhs.kdmahasiswa = krs.kdmahasiswa
        // straight_join pt_person per on per.kdperson = mhs.kdperson
        // straight_join gabung_nilai_metopen gnm on gnm.kdjenisnilai = p.kdjenisnilai");

        // dd($test);

        $penilaian = ak_penilaian::select("ak_penilaian.nilai as apnilai", "ak_penilaian.id as kdpen", "gnm.kdjenisnilai as kdjn", "nim", "namalengkap", "ak_penilaian.kdkrsnilai")
            ->join("ak_krsnilai as krs", "krs.kdkrsnilai", "=", "ak_penilaian.kdkrsnilai")
            ->join("ak_mahasiswa as mhs", "mhs.kdmahasiswa", "=", "krs.kdmahasiswa")
            ->join("pt_person as per", "per.kdperson", "=", "mhs.kdperson")
            ->join("gabung_nilai_metopen as gnm", "gnm.kdjenisnilai", "=", "ak_penilaian.kdjenisnilai")
            ->where("gnm.kdjenisnilai", "=", $id)
            ->get();

        // $penilaian = ak_penilaian::all();

        // dd($penilaian);

        // dd($kelas, $penilaian);

        return view('pages.metopen.tugas', compact('penilaian', 'kelas'));
    }

    public function postPenilaian(Request $request)
    {
        $request->validate([
            'kdpenilaian' => ['required', 'numeric'],
            'nilai' => ['required', 'numeric']
        ]);

        // abort_if($nilai, 404, 'data kosong');

        try {

            DB::beginTransaction();

            // $nilai = ak_penilaian::where('kdpenilaian', $request->input('kdpenilaian'))->first();

            $nilai = ak_penilaian::findOrFail($request->input("kdpenilaian"));

            // $nilai->nilai = $request->input('nilai');

            $nilai->update(['nilai' => $request->input('nilai')]);

            $nilai->save();

            DB::commit();


            return redirect()->back()->with('success', 'berhasil menambah nilai');
        } catch (Throwable $th) {
            dd($th);
            return redirect()->back()->with('failed', 'gagal menambah nilai. Error: ' . $th->getMessage());
        }
    }

    public function finalNilai(int $id)
    {

        $matakuliah = ak_matakuliah::select("matakuliah", "batasNilai", "namalengkap", "gelarbelakang")
            ->join("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
            ->join("ak_penawaranmatakuliah as pmk", "pmk.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
            ->join("ak_timteaching as att", "att.kdpenawaran", "=", "pmk.kdpenawaran")
            ->join("pt_person as per", "per.kdperson", "=", "att.kdperson")
            ->where('ak_matakuliah.kdmatakuliah', "=", $id)
            ->first();

        $cpl = ak_matakuliah::select("kode_cpl")
            ->join("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
            ->join("ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk", "cplcpmk.ak_kurikulum_cpmk_id", "=", "amc.id_cpmk")
            ->join("ak_kurikulum_cpls as akc", "akc.id", "=", "cplcpmk.ak_kurikulum_cpl_id")
            ->join("ak_penawaranmatakuliah as pmk", "pmk.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
            ->join("ak_timteaching as att", "att.kdpenawaran", "=", "pmk.kdpenawaran")
            ->join("pt_person as per", "per.kdperson", "=", "att.kdperson")
            ->where('ak_matakuliah.kdmatakuliah', "=", $id)
            ->where('pmk.kdtahunakademik', "=", 20231)
            ->distinct()
            ->get();

        $test = ak_matakuliah::select("ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian")
            ->join("ak_matakuliah_cpmk as amc", "amc.kdmatakuliah", "=", "ak_matakuliah.kdmatakuliah")
            ->join("ak_kurikulum_cpmks as kc", "kc.id", "=", "amc.id_cpmk")
            ->join("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "amc.id")
            ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
            ->join("gabung_nilai_metopen as gnm", "gnm.id_gabung_metopen", "=", "gmc.id")
            ->join("ak_penilaian as ap", "ap.kdjenisnilai", "=", "gnm.kdjenisnilai")
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
            ->where("ak_matakuliah.kdmatakuliah", "=", $id)
            ->where("ak_kurikulum.isObe", '=', 1)
            ->distinct()
            ->get();


        $tabel = ak_matakuliah_cpmk::select("gmc.id", "metode_penilaian", "bobot", "kode_cpmk", "kode_cpl")
            ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_cpmk.kdmatakuliah")
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

        $tabularNilai = DB::select('call sistem_obe.nilai_tabular(?)', [$id]);

        $persentaseLulus = DB::select('call sistem_obe.total_lulus(?)', [$id]);
        foreach ($persentaseLulus as $key => $item) {
            foreach ($item as $KY => $keys) {
                $nilaiAkhir[] = $keys;
            }
        }

        $plo = DB::select('call sistem_obe.persenplo(?)', [$id]);

        // foreach ($plo as $kunci => $tem) {
        //     foreach ($tem as $kun => $kuncis) {
        //         $persenplo[] = $kuncis;
        //     }
        // }

        $persenplo = json_decode(json_encode($plo), true);

        // dd(collect($persentaseLulus)->toArray());


        $nilai = json_decode(json_encode($tabularNilai), true);


        foreach ($nilai as $key => $value) {
            $loop = 1;
            foreach ($value as $urutanData => $data) {
                if ($loop <= 4) {
                    $mahasiswa[$key][] = $data;
                } else {
                    $mahasiswa[$key][4][] = $data;
                }
                $loop++;
            }
        }
        // dd($tabularNilai);

        foreach ($mahasiswa as $key => $mhs) {
            $gagal = false;
            foreach ($mhs[4] as $nilai) {
                if ($nilai < $matakuliah->batasNilai) {
                    $gagal = true;
                    break;
                }
            }
            array_push($mahasiswa[$key], $gagal);
        }

        // return dd($mahasiswa);

        return view('pages.metopen.final', compact('mahasiswa', 'tabel', 'matakuliah', 'cpl', 'persentaseLulus', 'nilaiAkhir', 'persenplo'));
    }
}
