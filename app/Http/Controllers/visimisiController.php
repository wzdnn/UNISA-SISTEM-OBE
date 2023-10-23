<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class visimisiController extends Controller
{
    //

    public function vmIndex()
    {
        $vm = DB::table('_visi')
            ->select('_visi.*')
            ->get();

        $misi = DB::table('_visi_misi')
            ->select('_visi_misi.*')
            ->get();

        $tujuan = DB::table('_visi_tujuan')
            ->select('_visi_tujuan.*')
            ->get();

        return view('pages.visidanmisi.index', compact('vm', 'misi', 'tujuan'));
    }
}
