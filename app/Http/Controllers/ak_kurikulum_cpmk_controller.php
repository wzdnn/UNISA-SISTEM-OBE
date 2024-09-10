<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_cpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ak_kurikulum_cpmk_controller extends Controller
{

    public function cpmkIndex(Request $request)
    {

        if (auth()->user()->kdunit == 42 || auth()->user()->kdunit == 0) {
            $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
                ->select('ak_kurikulum_cpls.*', 'ak_kurikulum.*')
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpls.kdkurikulum"
                )
                ->orderBy('ak_kurikulum_cpls.id')
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();

            $cpm = ak_kurikulum_cpmk::all();
        } elseif (auth()->user()->leveling == 3) {
            $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
                ->select('ak_kurikulum_cpls.*', 'ak_kurikulum.*')
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpls.kdkurikulum"
                )
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->orderBy('ak_kurikulum_cpls.id')
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->where("isObe", "=", 1)
                ->get();

            $cpm = ak_kurikulum_cpmk::all();
        } elseif (auth()->user()->leveling == 2) {
            $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
                ->select('ak_kurikulum_cpls.*', 'ak_kurikulum.*')
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpls.kdkurikulum"
                )
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where('ak_kurikulum.kdkurikulum', 67)
                ->orderBy('ak_kurikulum_cpls.id')
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->where('kdkurikulum', 67)
                ->get();

            $cpm = ak_kurikulum_cpmk::all();
        } else {
            $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
                ->select('ak_kurikulum_cpls.*', 'ak_kurikulum.*')
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpls.kdkurikulum"
                )
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->orderBy('ak_kurikulum_cpls.id')
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();

            $cpm = ak_kurikulum_cpmk::all();
        }

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }

        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
                    ->select('ak_kurikulum_cpls.*', 'ak_kurikulum.*')
                    ->join(
                        "ak_kurikulum",
                        "ak_kurikulum.kdkurikulum",
                        "=",
                        "ak_kurikulum_cpls.kdkurikulum"
                    )
                    ->where("ak_kurikulum.isObe", '=', 1)
                    ->where("kurikulum", "=", $request->filter)
                    ->orderBy('id', 'asc')
                    ->paginate(10);
            }
        }

        // return dd($CPMK);
        return view('pages.cpmk.home', compact('CPMK', 'cpm', 'kdkurikulum'));
    }

    public function cpmkList(Request $request)
    {

        $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();

        $akKurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();

        $ak_kurikulum_cpl = DB::table('ak_kurikulum_cpls')
            ->select(['id', 'kode_cpl', 'cpl'])
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpls.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        if (auth()->user()->kdunit == 42) {
            $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpmks.kdkurikulum"
                )
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 3) {
            $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpmks.kdkurikulum"
                )
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 2) {
            $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpmks.kdkurikulum"
                )
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("ak_kurikulum.kdkurikulum", 67)
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("ak_kurikulum.kdkurikulum", 67)
                ->where("isObe", "=", 1)
                ->get();
        } else {
            $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpmks.kdkurikulum"
                )
                ->where("ak_kurikulum.kdunitkerja", "=", Auth::user()->kdunit)
                ->orWhere("ak_kurikulum.kdunitkerja", '=', 0)
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();
        }

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }



        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
                    ->join(
                        "ak_kurikulum",
                        "ak_kurikulum.kdkurikulum",
                        "=",
                        "ak_kurikulum_cpmks.kdkurikulum"
                    )
                    ->where("ak_kurikulum.isObe", '=', 1)
                    ->where("kurikulum", "=", $request->filter)
                    ->orderBy('id', 'asc')
                    ->paginate(10);
            }
        }

        return view('pages.cpmk.list', compact('listCPMK', 'ak_kurikulum_cpl', 'sub_bk', 'akKurikulum', 'kdkurikulum'));
    }


    public function delete(int $id)
    {
        $cpmk = ak_kurikulum_cpmk::where('id', '=', $id)->with('CPMKtoCPL')->first();
        if (!$cpmk) {
            return abort(404);
        }

        try {
            $cpmk->CPMKtoCPL()->detach();
            $cpmk->delete();
            return redirect(url()->previous())->with('success', 'sukses hapus');
        } catch (Throwable $th) {
            return redirect(url()->previous())->with('failed', 'gagal hapus. Error : ' . $th->getMessage());
        }
    }

    public function cpmkStore(Request $request)
    {
        // $request->validate([
        //     'kode_cpmk',
        //     'cpmk'
        // ]);

        $cpmk = ak_kurikulum_cpmk::create([
            'kode_cpmk' => $request->kode_cpmk,
            'cpmk' => $request->cpmk,
            'kdkurikulum' => $request->unit

        ]);

        $cpmk->CPMKtoCPL()->attach($request->input('kdcpl'));

        return redirect()->route('list.cpmk')->with('success', 'CPMK Berhasil Ditambahkan');
    }

    public function cpmkEdit(int $id)
    {
        $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();

        $akKurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();

        $ak_kurikulum_cpl = DB::table('ak_kurikulum_cpls')
            ->select(['id', 'kode_cpl', 'cpl'])
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpls.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $cpmkEdit = ak_kurikulum_cpmk::findOrFail($id);

        return view('pages.cpmk.edit', compact('sub_bk', 'akKurikulum', 'ak_kurikulum_cpl', 'cpmkEdit'));
    }

    public function cpmkUpdate(Request $request, int $id)
    {
        $cplSelect = [];

        if ($request->has('kdcpl')) {
            foreach ($request->input("kdcpl") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($cplSelect, $value);
                }
            }
        }

        try {
            $cpmkEdit = ak_kurikulum_cpmk::findOrFail($id);
            DB::beginTransaction();

            $cpmkEdit->update([
                'kode_cpmk' => $request->kode_cpmk,
                'cpmk' => $request->cpmk
            ]);

            if (count($cplSelect) > 0) {
                $cpmkEdit->CPMKtoCPL()->sync($cplSelect);
            } else {
                $cpmkEdit->CPMKtoCPL()->detach();
            }

            DB::commit();
            return redirect()->route('list.cpmk')->with("success", "CPMK berhasil diupdate");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("faiiled", "gagal update cpmk" . $th->getMessage());
        }
    }
}
