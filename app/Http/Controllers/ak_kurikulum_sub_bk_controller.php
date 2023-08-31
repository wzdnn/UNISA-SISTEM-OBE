<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_sub_bk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_sub_bk_controller extends Controller
{
    //
    public function index()
    {
        // $akKurikulumSubBk = ak_kurikulum_sub_bk::all();

        $akKurikulumSubBk = DB::table('ak_kurikulum_sub_bks')
            ->select("ak_kurikulum_sub_bks.*", "ak_kurikulum_bks.bahan_kajian as ak_bk", "ak_kurikulum_bks.kode_bk as ak_kdbk", "ak_kurikulum.kurikulum")
            ->join(
                "ak_kurikulum_bks",
                "ak_kurikulum_bks.kdbk",
                "=",
                "ak_kurikulum_sub_bks.kdbk"
            )
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_sub_bks.kdkurikulum"
            )
            ->get();

        return view('pages.subBahanKajian.index', compact('akKurikulumSubBk'));
    }

    public function create()
    {

        $akKurikulumBk = DB::table('ak_kurikulum_bks')
            ->select(['kdbk', 'kode_bk', 'bahan_kajian'])
            ->get();
        $akKurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum'])
            ->get();
        return view('pages.subBahanKajian.create', compact('akKurikulumBk', 'akKurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_subbk',
            'sub_bk',
        ]);

        ak_kurikulum_sub_bk::create([
            'kode_subbk' => $request->kode_subbk,
            'sub_bk' => $request->sub_bk,
            'referensi' => $request->referensi,
            'kdbk' => $request->bahan_kajian,
            'kdkurikulum' => $request->unit
        ]);


        return redirect()->route('subbk.index')->with('success', 'Sub Bahan Kajian berhasil ditambah');
    }
}
