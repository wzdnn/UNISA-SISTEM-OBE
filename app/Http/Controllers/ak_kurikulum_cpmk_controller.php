<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_cpmk;
use Illuminate\Http\Request;

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
}
