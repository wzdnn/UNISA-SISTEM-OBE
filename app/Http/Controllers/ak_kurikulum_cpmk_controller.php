<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_cpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_cpmk_controller extends Controller
{
    //
    public function cpmkIndex()
    {
        $CPMK =
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

        return view('pages.cpmk.home', compact('CPMK'));
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

    public function cpmkMapping(Request $request)
    {
        $ak_kurikulum_cpl = ak_kurikulum_cpl::create([]);

        $ak_kurikulum_cpl->CpltoCpmk()->attach($request->input('kdcpmk'));

        return redirect()->route('cpmk')->with('success', 'CPMK berhasil dipetakan', compact('ak_kurikulum_cpl'));
    }
}
