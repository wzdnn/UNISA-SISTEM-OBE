<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_sub_bk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_sub_bk_controller extends Controller
{
    //
    public function index()
    {
        // $akKurikulumSubBk = ak_kurikulum_sub_bk::all();
        if (auth()->user()->kdunit == 100 || auth()->user()->kdunit == 0) {
            $akKurikulumSubBk = DB::table('ak_kurikulum_sub_bks')
                ->select("ak_kurikulum_sub_bks.*", "ak_kurikulum_bks.bahan_kajian as ak_bk", "ak_kurikulum_bks.kode_bk as ak_kdbk", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
                ->join(
                    "ak_kurikulum_bks",
                    "ak_kurikulum_bks.id",
                    "=",
                    "ak_kurikulum_sub_bks.kdbk"
                )
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_sub_bks.kdkurikulum"
                )
                ->paginate(10);
        } else {
            $akKurikulumSubBk = DB::table('ak_kurikulum_sub_bks')
                ->select("ak_kurikulum_sub_bks.*", "ak_kurikulum_bks.bahan_kajian as ak_bk", "ak_kurikulum_bks.kode_bk as ak_kdbk", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->join(
                    "ak_kurikulum_bks",
                    "ak_kurikulum_bks.id",
                    "=",
                    "ak_kurikulum_sub_bks.kdbk"
                )
                ->join(
                    "ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_sub_bks.kdkurikulum"
                )
                ->paginate(10);
        }


        return view('pages.subBahanKajian.index', compact('akKurikulumSubBk'));
    }

    public function listSubBK()
    {
        $SubBk = DB::table('ak_kurikulum_sub_bks')
            ->select("ak_kurikulum_sub_bks.*", "subbk_cpmk.ak_kurikulum_cpmk")
            ->leftJoin('subbk_cpmk', 'subbk_cpmk.ak_kurikulum_sub_bk_id', '=', 'ak_kurikulum_sub_bks.id')
            ->get();

        $SubBk->map(function ($SubBk) {
            $SubBk->ak_kurikulum_cpmk = (unserialize($SubBk->ak_kurikulum_cpmk)) ? unserialize($SubBk->ak_kurikulum_cpmk) : (object) null;
        });

        $cpmk = DB::table('ak_kurikulum_cpmks')->get();

        return view('pages.subBahanKajian.list', compact('SubBk', 'cpmk'));
    }

    public function create()
    {

        $akKurikulumBk = DB::table('ak_kurikulum_bks')
            ->select(['id', 'kode_bk', 'bahan_kajian'])
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_bks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();
        $akKurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
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

    public function edit(int $id)
    {
        $akKurikulumBk = DB::table('ak_kurikulum_bks')
            ->select(['id', 'kode_bk', 'bahan_kajian'])
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_bks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();
        $subBkEdit = ak_kurikulum_sub_bk::findOrFail($id);
        return view('pages.subBahanKajian.edit', compact('subBkEdit', 'akKurikulumBk'));
    }

    public function update(Request $request, int $id)
    {
        $subBkEdit = ak_kurikulum_sub_bk::findOrFail($id);
        $subBkEdit->update([
            'kode_subbk' => $request->kode_subbk,
            'sub_bk' => $request->sub_bk,
            'referensi' => $request->referensi,
            'id' => $request->bahan_kajian
        ]);
        return redirect()->route('subbk.index')->with('success', 'Sub BK Berhasil Disunting');
    }

    public function delete(int $id)
    {
        $subbk = ak_kurikulum_sub_bk::findOrFail($id);
        if (!$subbk) {
            return abort(404);
        }

        // return dd($pl);

        $subbk->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }

    public function MapCPMKShow(int $id)
    {
        $cpmk = DB::table('ak_kurikulum_cpmks')->get();
        $save = DB::table('subbk_cpmk')
            ->select('ak_kurikulum_cpmk')
            ->where('ak_kurikulum_sub_bk_id', '=', $id)->first();

        // return dd($cpmk);

        $data = [];
        if ($save != null) {
            $save->ak_kurikulum_cpmk = (unserialize($save->ak_kurikulum_cpmk)) ? unserialize($save->ak_kurikulum_cpmk) : null;
            $data = $save->ak_kurikulum_cpmk;
        }

        $save = $data;

        // return dd($save);

        return view('pages.subBahanKajian.showCPMK', compact('cpmk', 'id', 'save'));
    }

    public function MappingCPMK(Request $request, int $subbk)
    {
        $dataSBKCPMK = array();
        if ($request->cpmk != null) {
            foreach ($request->cpmk as $cpmk) {
                $dataSBKCPMK[] = $cpmk;
            }
        }

        $check = DB::table('subbk_cpmk')
            ->where('ak_kurikulum_sub_bk_id', '=', $subbk)
            ->first();

        if ($check) {
            DB::table('subbk_cpmk')
                ->where('ak_kurikulum_sub_bk_id', '=', $subbk)
                ->update([
                    'ak_kurikulum_cpmk' => serialize($dataSBKCPMK)
                ]);
        } else {
            DB::table('subbk_cpmk')
                ->where('ak_kurikulum_sub_bk_id', '=', $subbk)
                ->insert([
                    'ak_kurikulum_sub_bk_id' => $subbk,
                    'ak_kurikulum_cpmk' => serialize($dataSBKCPMK)
                ]);
        }
        return redirect()->route('list.subbk');
    }
}
