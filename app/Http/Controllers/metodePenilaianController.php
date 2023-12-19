<?php

namespace App\Http\Controllers;

use App\Models\ak_matakuliah;
use App\Models\gabung_metopen_cpmk;
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
            $matakuliah = ak_matakuliah::with("GetAllidSubBK.cpmks.metopens.CPMKtoMTP")
                ->where("isObe", '=', 1)
                ->orderBy('kdmatakuliah', 'asc')
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } else {
            $matakuliah = ak_matakuliah::with("GetAllidSubBK.cpmks.metopens.CPMKtoMTP")
                ->where("ak_kurikulum.isObe", '=', 1)
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->orderBy('kdmatakuliah', 'asc')
                // ->limit(5)->get();
                ->paginate(10);
            // ->first();

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
                $matakuliah = ak_matakuliah::with('MKtoSub_bk.SBKtoidCPMK', 'MKtoSub_bk.getSBKtoidCPMK', 'GetAllidSubBK')
                    ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                    ->where("ak_kurikulum.isObe", '=', 1)
                    ->where("kurikulum", "=", $request->filter)
                    ->orderBy('kdmatakuliah', 'asc')
                    ->paginate(10);
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
            'bobot' => ['nullable', 'numeric']
        ]);

        try {
            $mtp = gabung_metopen_cpmk::first();

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

        $metopenSelect = [];
        foreach ($metopen as $data) {
            array_push($metopenSelect, $data->metode_penilaian);
        }

        return view('pages.metopen.metopen', compact('metopen', 'metopenSelect'));
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

        try {
            $metopenCPMK = gabung_subbk_cpmk::where('id_cpmk', '=', $id)->with('CPMKtoMTP')->first();

            DB::beginTransaction();
            if (count($metopenSelect) > 0) {

                $metopenCPMK->CPMKtoMTP()->sync($metopenSelect);
            } else {
                $metopenCPMK->CPMKtoMTP()->detach();
            }

            DB::commit();
            // return dd($metopenCPMK, "success");
            return redirect()->back()->with("success", "berhasil update Metode Penilaian pada CPMK");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("failed", "gagal update" . $th->getMessage());
        }
    }

    public function tugasIndex()
    {
        return view('pages.metopen.tugas');
    }
}
