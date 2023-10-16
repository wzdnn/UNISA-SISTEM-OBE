<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_cpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class ak_kurikulum_cpmk_controller extends Controller
{

    public function cpmkIndex()
    {
        $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
            ->select('ak_kurikulum_cpls.*')
            ->orderBy('ak_kurikulum_cpls.id')
            ->get();

        // $CPMK->map(function ($CPMK) {
        //     $CPMK->ak_kurikulum_cpmk = (unserialize($CPMK->ak_kurikulum_cpmk)) ? unserialize($CPMK->ak_kurikulum_cpmk) : (object) null;
        //     // $CPMK->ak_kurikulum_cpmk = unserialize($CPMK->ak_kurikulum_cpmk);
        // });

        $cpm = ak_kurikulum_cpmk::all();

        // return dd($cpm);
        return view('pages.cpmk.home', compact('CPMK', 'cpm'));
    }

    public function cpmkList()
    {

        $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();

        $ak_kurikulum_cpl = DB::table('ak_kurikulum_cpls')
            ->select(['id', 'kode_cpl', 'cpl'])
            ->get();

        $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])->get();
        // $listCPMK = DB::table('ak_kurikulum_cpmks')->get();

        return view('pages.cpmk.list', compact('listCPMK', 'ak_kurikulum_cpl', 'sub_bk'));
    }

    public function cpmkStore(Request $request)
    {
        // $request->validate([
        //     'kode_cpmk',
        //     'cpmk'
        // ]);

        $cpmk = ak_kurikulum_cpmk::create([
            'kode_cpmk' => $request->kode_cpmk,
            'cpmk' => $request->cpmk
        ]);

        $cpmk->CPMKtoCPL()->attach($request->input('kdcpl'));

        return redirect()->route('list.cpmk')->with('success', 'CPMK Berhasil Ditambahkan');
    }

    // Belom Kepake

    public function cpmkEditGET(string $id)
    {
        $ak_kurikulum_cpl = DB::table('ak_kurikulum_cpls')
            ->select(['id', 'kode_cpl', 'cpl'])
            ->get();

        $cpmkEdit = ak_kurikulum_cpmk::findOrFail($id);
        return view('pages.cpmk.edit', compact('cpmkEdit', 'ak_kurikulum_cpl'));
    }

    public function cpmkEditPOST(Request $request, string $id)
    {
        $cpmkEdit = ak_kurikulum_cpmk::findOrFail($id);

        $cpmkEdit->update($request->all());
        // $cpmkEdit->CPMKtoCPL()->attach($request->input('kdcpl'));

        return redirect()->route('list.cpmk')->with('success', 'CPMK Berhasil Diedit');
    }
}
