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

        // $mk = ModelsMatakuliah::with(['MKtoSBK'])
        //     ->select("matakuliahs.*", "ak_kurikulum.kurikulum",)
        //     ->join(
        //         "ak_kurikulum",
        //         "ak_kurikulum.kdkurikulum",
        //         "=",
        //         "matakuliahs.kdkurikulum"
        //     )
        //     ->get();

        $mk = DB::table('ak_matakuliah')
            ->select('ak_matakuliah.*', 'ak_kurikulum.kurikulum')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_matakuliah.kdkurikulum"
            )
            ->where("isObe", "=", 1)
            ->get();

        // return dd($mk);

        return view('pages.MK.index', compact('mk'));
    }

    public function createMK()
    {

        $unit = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum'])
            ->get();
        $subBK = DB::table('ak_kurikulum_sub_bks')
            ->select(['id', 'kode_subbk', 'sub_bk'])
            ->get();
        return view('pages.MK.create', compact('unit', 'subBK'));
    }

    public function storeMK(Request $request)
    {
        $request->validate([
            'mk_singkat'
        ]);

        $mk_subbk = ModelsMatakuliah::create([
            'kodematakuliah' => $request->kodematakuliah,
            'matakuliah' => $request->matakuliah,
            'mk_singkat' => $request->mk_singkat,
            'kdkurikulum' => $request->unit
        ]);

        $mk_subbk->MktoSBK()->attach($request->input('subbk'));

        return redirect()->route('index.mk')->with('success', 'MK berhasil ditambahkan');
    }
}
