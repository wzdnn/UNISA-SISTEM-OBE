<?php

namespace App\Http\Controllers;

use App\Models\matakuliah as ModelsMatakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class matakuliah extends Controller
{
    //

    public function indexMK()
    {

        $mk = ModelsMatakuliah::with(['MKtoSBK'])
            ->select("matakuliahs.*", "ak_kurikulum.kurikulum", "ak_matakuliah.kodematakuliah", "ak_matakuliah.matakuliah")
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "matakuliahs.kdkurikulum"
            )
            ->join(
                "ak_matakuliah",
                "ak_matakuliah.kdmatakuliah",
                "=",
                "matakuliahs.kdmatakuliah"
            )
            ->get();

        // return dd($mk);

        return view('pages.MK.index', compact('mk'));
    }

    public function createMK()
    {

        $unit = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum'])
            ->get();
        $matakuliah = DB::table('ak_matakuliah')
            ->select(['kdmatakuliah', 'kodematakuliah', 'matakuliah'])
            ->get();
        $subBK = DB::table('ak_kurikulum_sub_bks')
            ->select(['kdsubbk', 'kode_subbk', 'sub_bk'])
            ->get();
        return view('pages.MK.create', compact('unit', 'matakuliah', 'subBK'));
    }
}
