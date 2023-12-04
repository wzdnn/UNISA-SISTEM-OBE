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

    // 

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

        if (auth()->user()->kdunit == 100 || auth()->user()->kdunit == 0) {
            $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpmks.kdkurikulum"
                )
                ->paginate(10);
        } else {
            $listCPMK = ak_kurikulum_cpmk::with(['CPMKtoCPL'])
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_cpmks.kdkurikulum"
                )
                ->where("ak_kurikulum.kdunitkerja", "=", Auth::user()->kdunit)
                ->orWhere("ak_kurikulum.kdunitkerja", '=', 0)
                ->paginate(10);
        }


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

    public function cpmkEdit(int $id)
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

        $cpmkEdit = ak_kurikulum_cpmk::findOrFail($id);

        return view('pages.cpmk.edit', compact('sub_bk', 'akKurikulum', 'ak_kurikulum_cpl', 'cpmkEdit'));
    }

    public function cpmkUpdate(Request $request, int $id)
    {
        $cplSelect = [];

        if ($request->has('kdcpl')) {
            foreach ($request->input("kdcpl") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($cplSelect, $value);
                }
            }
        }

        try {
            $cpmkEdit = ak_kurikulum_cpmk::findOrFail($id);
            DB::beginTransaction();

            $cpmkEdit->update([
                'kode_cpmk' => $request->kode_cpmk,
                'cpmk' => $request->cpmk
            ]);

            if (count($cplSelect) > 0) {
                $cpmkEdit->CPMKtoCPL()->sync($cplSelect);
            } else {
                $cpmkEdit->CPMKtoCPL()->detach();
            }

            DB::commit();
            return redirect()->route('list.cpmk')->with("success", "CPMK berhasil diupdate");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("faiiled", "gagal update cpmk" . $th->getMessage());
        }
    }
}
