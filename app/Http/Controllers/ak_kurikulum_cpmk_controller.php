<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_cpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class ak_kurikulum_cpmk_controller extends Controller
{
    //
    public function cpmkIndex()
    {
        $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
            ->select('ak_kurikulum_cpls.*', 'ak_kurikulum_cpl_ak_kurikulum_cpmk.ak_kurikulum_cpmk')
            ->leftJoin('ak_kurikulum_cpl_ak_kurikulum_cpmk', 'ak_kurikulum_cpl_ak_kurikulum_cpmk.ak_kurikulum_cpl_id', '=', 'ak_kurikulum_cpls.id')
            ->orderBy('ak_kurikulum_cpls.id')
            ->get();

        $CPMK->map(function ($CPMK) {
            $CPMK->ak_kurikulum_cpmk = (unserialize($CPMK->ak_kurikulum_cpmk)) ? unserialize($CPMK->ak_kurikulum_cpmk) : (object) null;
            // $CPMK->ak_kurikulum_cpmk = unserialize($CPMK->ak_kurikulum_cpmk);
        });

        $cpm = DB::table('ak_kurikulum_cpmks')->get();

        // return dd($cpm);
        return view('pages.cpmk.home', compact('CPMK', 'cpm'));
    }

    public function cpmkList()
    {
        $listCPMK = ak_kurikulum_cpmk::all();
        // $listCPMK = DB::table('ak_kurikulum_cpmks')->get();

        return view('pages.cpmk.list', compact('listCPMK'));
    }


    public function cpmkStore(Request $request)
    {
        $request->validate([
            'kode_cpmk',
            'cpmk'
        ]);

        ak_kurikulum_cpmk::create([
            'kode_cpmk' => $request->kode_cpmk,
            'cpmk' => $request->cpmk
        ]);

        return redirect()->route('list.cpmk')->with('success', 'CPMK Berhasil Ditambahkan');
    }

    /**
     * GET Mapping
     */
    public function cpmkShow(int $id)
    {
        $cpmk = DB::table('ak_kurikulum_cpmks')->get();
        $save = DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
            ->select('ak_kurikulum_cpmk')
            ->where('ak_kurikulum_cpl_id', '=', $id)->first();

        $data = [];
        if ($save != null) {
            $save->ak_kurikulum_cpmk = (unserialize($save->ak_kurikulum_cpmk)) ? unserialize($save->ak_kurikulum_cpmk) : null;
            $data = $save->ak_kurikulum_cpmk;
        }

        $save = $data;
        // $save->ak_kurikulum_cpmk = unserialize($save->ak_kurikulum_cpmk);

        // return dd($save);
        return view('pages.cpmk.show', compact('cpmk', 'id', 'save'));
    }

    /**
     * POST MAPING 
     */
    public function cpmkMapping(Request $request, int $cpl)
    {


        $dataCPMK = array();
        if ($request->cpmk != null) {
            foreach ($request->cpmk as $cpmk) {
                $dataCPMK[] = $cpmk;
            }
        }

        $check = DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
            ->where('ak_kurikulum_cpl_id', '=', $cpl)
            ->first();

        if ($check) {
            DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
                ->where('ak_kurikulum_cpl_id', '=', $cpl)
                ->update([
                    'ak_kurikulum_cpmk' => serialize($dataCPMK)
                ]);
        } else {
            DB::table('ak_kurikulum_cpl_ak_kurikulum_cpmk')
                ->insert([
                    'ak_kurikulum_cpl_id' => $cpl,
                    'ak_kurikulum_cpmk' => serialize($dataCPMK)
                ]);
        }
        return redirect()->route('cpmk');
    }

    // Belom Kepake

    // public function cpmkEditGET(string $id)
    // {
    //     $cpmkEdit = ak_kurikulum_cpmk::findOrFail($id);
    //     return view('pages.cpmk.edit', compact('cpmkEdit'));
    // }

    // public function cpmkEditPOST(Request $request, string $id)
    // {
    //     $cpmkEdit = ak_kurikulum_cpmk::findOrFail($id);

    //     $cpmkEdit->update($request->all());

    //     return redirect()->route('list.cpmk')->with('success', 'CPMK Berhasil Diedit');
    // }
}
