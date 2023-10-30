<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cplr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_cplr_Controller extends Controller
{
    //
    public function index()
    {
        // $akKurikulumCplr = ak_kurikulum_cplr::all();

        $akKurikulumCplr = DB::table('ak_kurikulum_cplrs')
            ->select("ak_kurikulum_cplrs.*", "ak_kurikulum_aspeks.aspek as ak_aspek", "ak_kurikulum_sumbers.sumber as ak_sumber", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
            ->join(
                "ak_kurikulum_aspeks",
                "ak_kurikulum_aspeks.id",
                "=",
                "ak_kurikulum_cplrs.kdaspek"
            )
            ->join(
                "ak_kurikulum_sumbers",
                "ak_kurikulum_sumbers.id",
                "=",
                "ak_kurikulum_cplrs.kdsumber"
            )
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cplrs.kdkurikulum"
            )
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy("ak_kurikulum_cplrs.id")
            ->get();

        return view('pages.cplr.index', compact('akKurikulumCplr'));
    }

    public function create()
    {
        $akKurikulumAspek = DB::table('ak_kurikulum_aspeks')
            ->select(["id", "aspek"])
            ->get();
        $akKurikulumSumber = DB::table('ak_kurikulum_sumbers')
            ->select(["id", "sumber"])
            ->get();
        $akKurikulum = DB::table('ak_kurikulum')
            ->select(["kdkurikulum", "kurikulum", "tahun"])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();


        return view('pages.cplr.create', compact('akKurikulumAspek', 'akKurikulumSumber', 'akKurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cplr',
            'cplr',
        ]);

        ak_kurikulum_cplr::create([
            'kode_cplr' => $request->kode_cplr,
            'cplr' => $request->cplr,
            'deskripsi_cplr' => $request->deskripsi_cplr,
            'kdaspek' => $request->aspek,
            'kdsumber' => $request->sumber,
            'kdkurikulum' => $request->unit
        ]);

        return redirect()->route('cplr.index')->with('success', 'Sumber Referensi Berhasil Ditambahkan');
    }

    public function edit(int $id)
    {
        $akKurikulumAspek = DB::table('ak_kurikulum_aspeks')
            ->select(["id", "aspek"])
            ->get();
        $akKurikulumSumber = DB::table('ak_kurikulum_sumbers')
            ->select(["id", "sumber"])
            ->get();
        $cplrEdit = ak_kurikulum_cplr::findOrFail($id);

        return view('pages.cplr.edit', compact('cplrEdit', 'akKurikulumAspek', 'akKurikulumSumber'));
    }

    public function update(Request $request, int $id)
    {

        $cplrEdit = ak_kurikulum_cplr::findOrFail($id);
        $cplrEdit->update([
            'kode_cplr' => $request->kode_cplr,
            'cplr' => $request->cplr,
            'deskripsi_cplr' => $request->deskripsi_cplr,
            'kdaspek' => $request->aspek,
            'kdsumber' => $request->sumber,
        ]);
        return redirect()->route('cplr.index')->with('success', 'Sumber Referensi Berhasil Disunting');
    }
    public function delete(int $id)
    {
        $cplr = ak_kurikulum_cplr::findOrFail($id);
        if (!$cplr) {
            return abort(404);
        }

        // return dd($pl);

        $cplr->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }
}
