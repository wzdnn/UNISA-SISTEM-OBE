<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_cpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_cpmk_controller extends Controller
{
    //
    public function index()
    {
        $akKurikulumCpmk = ak_kurikulum_cpl::with(['CpltoCplr', 'CpltoCpmk'])->get();
        // return dd($akKurikulumCPL);

        return view('pages.cpmk.index', compact('akKurikulumCpmk'));
    }

    public function create()
    {
        $akKurikulumCplCpmk =
            ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr'])
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

        return view('pages.cpmk.create', compact('akKurikulumCplCpmk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpmk',
            'cpmk'
        ]);

        $akKurikulumCpmk = ak_kurikulum_cpmk::create([
            'kode_cpmk' => $request->kode_cpmk,
            'cpmk' => $request->cpmk
        ]);

        $akKurikulumCpmk->CpltoCpmk()->attach($request->input('kdcpmk'));
    }

    public function update(Request $request, string $id)
    {
        $akKurikulumCpmk = ak_kurikulum_cpl::findOrFail($id);

        $akKurikulumCpmk->update($request->all())->CpltoCpmk()->attach($request->input('kdcpmk'));
    }
}
