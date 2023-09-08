<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ak_matakuliah_controller extends Controller
{
    //
    public function matakuliahIndex()
    {
        $ak_matakuliah = DB::table('ak_matakuliah')
            ->select("ak_matakuliah.*", "ak_kurikulum.kurikulum")
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_matakuliah.kdkurikulum"
            )
            ->orderBy("ak_matakuliah.kdmatakuliah")
            ->get();
        return view('pages.matakuliah.index', compact('ak_matakuliah'));
    }

    public function matakuliahMapSBKShow(int $id)
    {
        $subBK = DB::table('ak_kurikulum_sub_bks');
        return view('pages.matakuliah.showSBK', compact('subBk', 'id'));
    }
}
