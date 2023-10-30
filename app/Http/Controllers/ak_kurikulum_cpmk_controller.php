<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpl;
use App\Models\ak_kurikulum_cpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

use function PHPSTORM_META\map;

class ak_kurikulum_cpmk_controller extends Controller
{

    public function cpmkIndex()
    {
        // $CPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
        //     ->select('ak_kurikulum_cpmks.*')
        //     ->orderBy('ak_kurikulum_cpmks.id')
        //     ->get();
        $CPMK = ak_kurikulum_cpl::with(['CpltoPl', 'CpltoCplr', 'CpltoCpmk'])
            ->select('ak_kurikulum_cpls.*')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpls.kdkurikulum"
            )
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('ak_kurikulum_cpls.id')
            ->get();

        // $CPMK->map(function ($CPMK) {
        //     $CPMK->ak_kurikulum_cpmk = (unserialize($CPMK->ak_kurikulum_cpmk)) ? unserialize($CPMK->ak_kurikulum_cpmk) : (object) null;
        //     // $CPMK->ak_kurikulum_cpmk = unserialize($CPMK->ak_kurikulum_cpmk);
        // });

        $cpm = ak_kurikulum_cpmk::all();

        // return dd($CPMK);
        return view('pages.cpmk.home', compact('CPMK', 'cpm'));
    }

    public function cpmkList()
    {

        $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();

        $akKurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();

        $ak_kurikulum_cpl = DB::table('ak_kurikulum_cpls')
            ->select(['id', 'kode_cpl', 'cpl'])
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpls.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpmks.kdkurikulum"
            )
            ->where("ak_kurikulum.kdunitkerja", "=", Auth::user()->kdunit)
            ->orWhere("ak_kurikulum.kdunitkerja", '=', 0)
            ->get();

        // return dd($listCPMK);
        // $listCPMK = DB::table('ak_kurikulum_cpmks')->get();

        return view('pages.cpmk.list', compact('listCPMK', 'ak_kurikulum_cpl', 'sub_bk', 'akKurikulum'));
    }


    public function delete(int $id)
    {
        $cpmk = ak_kurikulum_cpmk::where('id', '=', $id)->with('CPMKtoCPL')->first();
        if (!$cpmk) {
            return abort(404);
        }

        try {
            $cpmk->CPMKtoCPL()->detach();
            $cpmk->delete();
            return redirect(url()->previous())->with('success', 'sukses hapus');
        } catch (Throwable $th) {
            return redirect(url()->previous())->with('failed', 'gagal hapus. Error : ' . $th->getMessage());
        }
    }

    public function cpmkStore(Request $request)
    {
        // $request->validate([
        //     'kode_cpmk',
        //     'cpmk'
        // ]);

        $cpmk = ak_kurikulum_cpmk::create([
            'kode_cpmk' => $request->kode_cpmk,
            'cpmk' => $request->cpmk,
            'kdkurikulum' => $request->unit

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
