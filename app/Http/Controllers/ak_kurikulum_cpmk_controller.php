<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_cpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class ak_kurikulum_cpmk_controller extends Controller
{
    //
    public function cpmkIndex()
    {
        // $CPMK =
        //     ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
        //     ->select("ak_kurikulum_cpls.*", "ak_kurikulum_aspeks.aspek", "ak_kurikulum.kurikulum")
        //     ->join(
        //         "ak_kurikulum_aspeks",
        //         "ak_kurikulum_aspeks.kdaspek",
        //         "=",
        //         "ak_kurikulum_cpls.kdaspek"
        //     )
        //     ->join(
        //         "ak_kurikulum",
        //         "ak_kurikulum.kdkurikulum",
        //         "=",
        //         "ak_kurikulum_cpls.kdkurikulum"
        //     )->orderBy('ak_kurikulum_cpls.id')
        //     ->get();

        // $CPMK = DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
        //     ->select('ak_kurikulum_cpl_ak_kurikulum_cpmk.ak_kurikulum_cpmk', 'ak_kurikulum_cpls.*')
        //     ->leftJoin('ak_kurikulum_cpls', 'ak_kurikulum_cpls.id', '=', 'ak_kurikulum_cpl_ak_kurikulum_cpmk.ak_kurikulum_cpl_id')
        //     ->get();

        // $CPMK = DB::table('ak_kurikulum_cpls')
        $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
            ->select('ak_kurikulum_cpls.*', 'ak_kurikulum_cpl_ak_kurikulum_cpmk.ak_kurikulum_cpmk')
            ->leftJoin('ak_kurikulum_cpl_ak_kurikulum_cpmk', 'ak_kurikulum_cpl_ak_kurikulum_cpmk.ak_kurikulum_cpl_id', '=', 'ak_kurikulum_cpls.id')
            ->orderBy('ak_kurikulum_cpls.id')
            ->get();
        // return dd($CPMK);

        $CPMK->map(function ($CPMK) {
            $CPMK->ak_kurikulum_cpmk = (unserialize($CPMK->ak_kurikulum_cpmk)) ? unserialize($CPMK->ak_kurikulum_cpmk) : (object) null;
        });

        // foreach ($CPMK as $cpmk) {
        //     print_r($cpmk->ak_kurikulum_cpmk) . '<br>';
        // }
        $cpm = DB::table('ak_kurikulum_cpmks')->get();

        // return dd($cpm);
        return view('pages.cpmk.home', compact('CPMK', 'cpm'));
    }

    public function cpmkList()
    {
        $listCPMK = ak_kurikulum_cpmk::all();

        return view('pages.cpmk.list', compact('listCPMK'));
    }


    public function cpmkStore(Request $request)
    {
        $request->validate([
            'kode_cpmk',
            'cpmk'
        ]);

        ak_kurikulum_cpmk::create([
            'kode_cpmk' => $request->kode_cpmk,
            'cpmk' => $request->cpmk
        ]);

        return redirect()->route('list.cpmk')->with('success', 'CPMK Berhasil Ditambahkan');
    }

    public function cpmkMapStore()
    {
        $ak_kurikulum_cpl = DB::table('ak_kurikulum_cpls')
            ->select(['id', 'kode_cpl', 'cpl'])
            ->get();

        $ak_kurikulum_cpmk = DB::table('ak_kurikulum_cpmks')->get();

        return view('pages.cpmk.map', compact('ak_kurikulum_cpl', 'ak_kurikulum_cpmk'));
    }

    public function cpmkShow(int $id)
    {
        $cpmkShow =
            ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
            ->select("ak_kurikulum_cpls.*", "ak_kurikulum_aspeks.aspek", "ak_kurikulum.kurikulum")
            ->join(
                "ak_kurikulum_aspeks",
                "ak_kurikulum_aspeks.kdaspek",
                "=",
                "ak_kurikulum_cpls.kdaspek"
            )
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpls.kdkurikulum"
            )
            ->get();

        // return dd($cpmkShow);
        // $cpmkL = DB::table('ak_kurikulum_cpls')
        //     ->select('ak_kurikulum_cpls.id', 'ak_kurikulum_cpl_ak_kurikulum_cpmk.ak_kurikulum_cpmk')
        //     ->leftJoin('ak_kurikulum_cpl_ak_kurikulum_cpmk', 'ak_kurikulum_cpl_ak_kurikulum_cpmk.id', '=', 'ak_kurikulum_cpls.id')
        //     ->get();

        // return dd($cpmkL);
        // return view('pages.cpmk.home', compact('CPMK'));

        $cpmk = DB::table('ak_kurikulum_cpmks')->get();
        return view('pages.cpmk.show', compact('cpmkShow', 'cpmk', 'id'));
    }

    public function cpmkMapping(Request $request, int $cpl)
    {
        // $ak_kurikulum_cpl = ak_kurikulum_cpl::create([]);

        // $ak_kurikulum_cpl->CpltoCpmk()->attach($request->input('kdcpmk'));

        // return redirect()->route('cpmk')->with('success', 'CPMK berhasil dipetakan', compact('ak_kurikulum_cpl'));

        $dataCPMK = array();
        if ($request->cpmk != null) {
            foreach ($request->cpmk as $cpmk) {
                $dataCPMK[] = $cpmk;
            }
        }

        $check = DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
            ->where('ak_kurikulum_cpl_id', '=', $cpl)
            ->first();

        if ($check) {
            DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
                ->where('ak_kurikulum_cpl_id', '=', $cpl)
                ->update([
                    'ak_kurikulum_cpmk' => serialize($dataCPMK)
                ]);
        } else {
            DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
                ->insert([
                    'ak_kurikulum_cpl_id' => $cpl,
                    'ak_kurikulum_cpmk' => serialize($dataCPMK)
                ]);
        }
        return redirect()->route('cpmk');
    }
}
