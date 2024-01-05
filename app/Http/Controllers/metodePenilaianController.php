<?php

namespace App\Http\Controllers;

use App\Models\ak_matakuliah;
use App\Models\gabung_metopen_cpmk;
use App\Models\gabung_mk_cpmk;
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

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } else {


            $matakuliah = ak_matakuliah::select("ak_matakuliah.kdmatakuliah", "kodematakuliah", "matakuliah", "kc.kode_cpmk", "metode_penilaian", "bobot", "amc.id as amcid", "gmc.id as gmcid")
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
                ->paginate(15);

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


        return view('pages.metopen.index', compact('matakuliah', 'kdkurikulum'));
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

    public function tugasPost(int $id, Request $request)
    {
    }
}
