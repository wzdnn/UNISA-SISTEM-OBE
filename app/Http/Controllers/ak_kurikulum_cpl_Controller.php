<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_cpl_Controller extends Controller
{
    //
    public function index()
    {
        $akKurikulumCpl = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
            ->select("ak_kurikulum_cpls.*", "ak_kurikulum_aspeks.aspek", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
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
            ->orderBy('ak_kurikulum_cpls.id')
            ->get();

        // dd(ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr'])
        //     ->select("ak_kurikulum_cpls.*", "ak_kurikulum_aspeks.aspek", "ak_kurikulum.kurikulum")
        //     ->join(
        //         "ak_kurikulum_aspeks",
        //         "ak_kurikulum_aspeks.kdaspek",
        //         "=",
        //         "ak_kurikulum_cpls.kdaspek"
        //     )
        //     ->join(
        //         "ak_kurikulum",
        //         "ak_kurikulum.kdkurikulum",
        //         "=",
        //         "ak_kurikulum_cpls.kdkurikulum"
        //     )->toSql());



        return view('pages.cpl.index', compact('akKurikulumCpl'));
    }

    public function create()
    {
        $ak_kurikulum_pl = DB::table('ak_kurikulum_pls')
            ->select(['id', 'kode_pl', 'profile_lulusan'])
            ->get();

        $ak_kurikulum_cplr = DB::table('ak_kurikulum_cplrs')
            ->select(['id', 'kode_cplr', 'cplr'])
            ->get();

        $ak_kurikulum_aspek = DB::table('ak_kurikulum_aspeks')
            ->select(['kdaspek', 'aspek'])
            ->get();

        $ak_kurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->get();

        return view('pages.cpl.create', compact('ak_kurikulum_pl', 'ak_kurikulum_cplr', 'ak_kurikulum_aspek', 'ak_kurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpl',
            'cpl'
        ]);

        $cpl = ak_kurikulum_cpl::create([
            'kode_cpl' => $request->kode_cpl,
            'cpl' => $request->cpl,
            'deskripsi_cpl' => $request->deskripsi_cpl,
            'kdaspek' => $request->aspek,
            'kdkurikulum' => $request->unit
        ]);

        // Pivot CPL to PL
        $cpl->CpltoPl()->attach($request->input('kdpl'));

        // Pivot CPL to CPLR
        $cpl->CpltoCplr()->attach($request->input('kdcplr'));

        return redirect()->route('cpl.index')->with('success', 'CPL berhasil ditambahkan');
    }

    public function edit(int $id)
    {

        $ak_kurikulum_pl = DB::table('ak_kurikulum_pls')
            ->select(['id', 'kode_pl', 'profile_lulusan'])
            ->get();

        $ak_kurikulum_cplr = DB::table('ak_kurikulum_cplrs')
            ->select(['id', 'kode_cplr', 'cplr'])
            ->get();

        $ak_kurikulum_aspek = DB::table('ak_kurikulum_aspeks')
            ->select(['kdaspek', 'aspek'])
            ->get();

        $cplEdit = ak_kurikulum_cpl::findOrFail($id);

        return view('pages.cpl.edit', compact('cplEdit', 'ak_kurikulum_aspek', 'ak_kurikulum_pl', 'ak_kurikulum_cplr'));
    }

    public function update(Request $request, int $id)
    {
        $cplEdit = ak_kurikulum_cpl::findOrFail($id);
        $cplEdit->update([
            'kode_cpl' => $request->kode_cpl,
            'cpl' => $request->cpl,
            'deskripsi_cpl' => $request->deskripsi_cpl,
            'kdaspek' => $request->aspek,
        ]);

        // Pivot CPL to PL
        $cplEdit->CpltoPl()->attach($request->input('kdpl'));

        // Pivot CPL to CPLR
        $cplEdit->CpltoCplr()->attach($request->input('kdcplr'));

        return redirect()->route('cpl.index')->with('success', 'CPL berhasil ditambahkan');
    }
}
