<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_bk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_bk_controller extends Controller
{
    //
    public function index()
    {
        // $akKurikulumBk = ak_kurikulum_bk::all();
        $akKurikulumBk = DB::table('ak_kurikulum_bks')
            ->select(
                "ak_kurikulum_bks.*",
                "ak_kurikulum_basis_ilmus.basis_ilmu as ak_basil",
                "ak_kurikulum_bidang_ilmus.bidang_ilmu as ak_bidil",
                "ak_kurikulum.kurikulum",
                "ak_kurikulum.tahun"
            )
            ->join(
                "ak_kurikulum_basis_ilmus",
                "ak_kurikulum_basis_ilmus.id",
                "=",
                "ak_kurikulum_bks.id"
            )
            ->join(
                "ak_kurikulum_bidang_ilmus",
                "ak_kurikulum_bidang_ilmus.id",
                "=",
                "ak_kurikulum_bks.id"
            )
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_bks.kdkurikulum"
            )
            ->get();

        return view('pages.bahanKajian.index', compact('akKurikulumBk'));
    }

    public function create()
    {
        $akKurikulumBasil = DB::table('ak_kurikulum_basis_ilmus')
            ->select(['id', 'basis_ilmu'])
            ->get();
        $akKurikulumBidil = DB::table('ak_kurikulum_bidang_ilmus')
            ->select(['id', 'bidang_ilmu'])
            ->get();
        $akKurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->get();
        return view('pages.bahanKajian.create', compact('akKurikulumBasil', 'akKurikulumBidil', 'akKurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bk',
            'bahan_kajian'
        ]);

        ak_kurikulum_bk::create([
            'kode_bk' => $request->kode_bk,
            'bahan_kajian' => $request->bahan_kajian,
            'id' => $request->basil,
            'id' => $request->bidil,
            'kdkurikulum' => $request->unit
        ]);


        return redirect()->route('bk.index')->with('success', 'Bahan Kajian berhasil ditambah');
    }

    public function delete(int $id)
    {
        $bk = ak_kurikulum_bk::findOrFail($id);
        if (!$bk) {
            return abort(404);
        }

        // return dd($pl);

        $bk->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }

    public function showBKSBK()
    {
        $akKurikulumBk = DB::table('ak_kurikulum_bks')
            ->select('ak_kurikulum_bks.*', 'ak_kurikulum_sub_bks.*')
            ->join('ak_kurikulum_sub_bks', 'ak_kurikulum_sub_bks.kdbk', '=', 'ak_kurikulum_bks.kdbk')
            ->get();

        return view('pages.bahanKajian.showBKSBK', compact('akKurikulumBk'));
    }
}
