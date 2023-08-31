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
        return view('pages.cpmk.create');
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
    }
}
