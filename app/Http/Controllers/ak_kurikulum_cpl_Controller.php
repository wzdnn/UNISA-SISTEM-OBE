<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ak_kurikulum_cpl_Controller extends Controller
{
    //
    public function index()
    {
        $akKurikulumCpl = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
            ->select("ak_kurikulum_cpls.*", "ak_kurikulum_aspeks.aspek", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
            ->join(
                "ak_kurikulum_aspeks",
                "ak_kurikulum_aspeks.id",
                "=",
                "ak_kurikulum_cpls.id"
            )
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpls.kdkurikulum"
            )
            ->get();

        // dd(ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr'])
        //     ->select("ak_kurikulum_cpls.*", "ak_kurikulum_aspeks.aspek", "ak_kurikulum.kurikulum")
        //     ->join(
        //         "ak_kurikulum_aspeks",
        //         "ak_kurikulum_aspeks.id",
        //         "=",
        //         "ak_kurikulum_cpls.id"
        //     )
        //     ->join(
        //         "ak_kurikulum",
        //         "ak_kurikulum.kdkurikulum",
        //         "=",
        //         "ak_kurikulum_cpls.kdkurikulum"
        //     )->toSql());



        return view('pages.cpl.index', compact('akKurikulumCpl'));
    }

    public function delete(int $id)
    {
        $cpl = ak_kurikulum_cpl::where('id', '=', $id)->with('CpltoPl', 'CpltoCplr')->first();
        if (!$cpl) {
            return abort(404);
        }

        try {
            $cpl->CpltoPl()->detach();
            $cpl->CpltoCplr()->detach();
            $cpl->delete();
            return redirect(url()->previous())->with('success', 'sukses hapus');
        } catch (Throwable $th) {
            return redirect(url()->previous())->with('failed', 'gagal hapus. Error : ' . $th->getMessage());
        }
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
            ->select(['id', 'aspek'])
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
            'id' => $request->aspek,
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
            ->select(['id', 'aspek'])
            ->get();

        $cplEdit = ak_kurikulum_cpl::findOrFail($id);

        return view('pages.cpl.edit', compact('cplEdit', 'ak_kurikulum_aspek', 'ak_kurikulum_pl', 'ak_kurikulum_cplr'));
    }

    public function update(Request $request, int $id)
    {

        // $cplEdit->update([
        //     'kode_cpl' => $request->kode_cpl,
        //     'cpl' => $request->cpl,
        //     'deskripsi_cpl' => $request->deskripsi_cpl,
        //     'id' => $request->aspek,
        // ]);

        $plSelect = [];
        $cplrSelect = [];

        if ($request->has('kdpl')) {
            foreach ($request->input("kdpl") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($plSelect, $value);
                }
            }
        }

        if ($request->has('kdcplr')) {
            foreach ($request->input("kdcplr") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($cplrSelect, $value);
                }
            }
        }

        try {
            $cplEdit = ak_kurikulum_cpl::findOrFail($id);

            DB::beginTransaction();

            $cplEdit->update([
                'kode_cpl' => $request->kode_cpl,
                'cpl' => $request->cpl,
                'deskripsi_cpl' => $request->deskripsi_cpl,
                'id' => $request->aspek,
            ]);

            // $cplEdit->kode_cpl = $request->input('kode_cpl');
            // $cplEdit->cpl = $request->input('cpl');
            // $cplEdit->deskripsi_cpl = $request->input('deskripsi_cpl');
            // $cplEdit->id = $request->input('aspek');

            if (count($plSelect) > 0) {
                $cplEdit->CpltoPl()->sync($plSelect);
            } else {
                $cplEdit->CpltoPl()->detach();
            }

            if (count($cplrSelect) > 0) {
                $cplEdit->CpltoCplr()->sync($cplrSelect);
            } else {
                $cplEdit->CpltoCplr()->detach();
            }

            DB::commit();
            return redirect()->route('cpl.index')->with('success', 'CPL berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("failed", "gagal update Sub BK pada Matkul" . $th->getMessage());
        }
    }
}
