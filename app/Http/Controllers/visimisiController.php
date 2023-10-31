<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class visimisiController extends Controller
{
    //

    public function vmIndex()
    {
        $visiU = DB::select('call simaku.visi_misi_tujuan(?,1,1)', [Auth::user()->kdunit]);
        $visiF = DB::select('call simaku.visi_misi_tujuan(?,2,1)', [Auth::user()->kdunit]);
        $visiP = DB::select('call simaku.visi_misi_tujuan(?,3,1)', [Auth::user()->kdunit]);

        $misiU = DB::select('call simaku.visi_misi_tujuan(?,1,2)', [Auth::user()->kdunit]);
        $misiF = DB::select('call simaku.visi_misi_tujuan(?,2,2)', [Auth::user()->kdunit]);
        $misiP = DB::select('call simaku.visi_misi_tujuan(?,3,2)', [Auth::user()->kdunit]);

        $tujuanU = DB::select('call simaku.visi_misi_tujuan(?,1,3)', [Auth::user()->kdunit]);
        $tujuanF = DB::select('call simaku.visi_misi_tujuan(?,2,3)', [Auth::user()->kdunit]);
        $tujuanP = DB::select('call simaku.visi_misi_tujuan(?,3,3)', [Auth::user()->kdunit]);

        return view('pages.visidanmisi.index', compact('tujuanU', 'tujuanF', 'tujuanP', 'visiU', 'visiF', 'visiP', 'misiU', 'misiF', 'misiP'));
    }
    public function vmIndexUser()
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

        return view('pages.visidanmisiuser.index', compact('vm', 'misi', 'tujuan'));
    }
}
