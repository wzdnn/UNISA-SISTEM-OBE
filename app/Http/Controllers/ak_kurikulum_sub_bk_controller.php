<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_sub_bk;
use App\Models\ak_muatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_sub_bk_controller extends Controller
{
    // method sbk index
    public function index(Request $request)
    {
        if (auth()->user()->kdunit == 42 || auth()->user()->kdunit == 100) {
            $akKurikulumSubBk = DB::table('ak_kurikulum_sub_bks')
                ->select("ak_kurikulum_sub_bks.*", "ak_kurikulum_bks.bahan_kajian as ak_bk", "ak_kurikulum_bks.kode_bk as ak_kdbk", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun", "jenismuatan", "gabung_sbk_muatan.id as sbmid")
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
                ->join(
                    "gabung_sbk_muatan",
                    "gabung_sbk_muatan.id_subbk",
                    "=",
                    "ak_kurikulum_sub_bks.id"
                )
                ->join(
                    "ak_muatan",
                    "ak_muatan.kdmuatan",
                    "=",
                    "gabung_sbk_muatan.kdmuatan"
                )
                ->distinct()
                ->paginate(10);
            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 3) {
            $akKurikulumSubBk = DB::table('ak_kurikulum_sub_bks')
                ->select("ak_kurikulum_sub_bks.*", "ak_kurikulum_bks.bahan_kajian as ak_bk", "ak_kurikulum_bks.kode_bk as ak_kdbk", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun", "jenismuatan", "gabung_sbk_muatan.id as sbmid")
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
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->leftJoin(
                    "gabung_sbk_muatan",
                    "gabung_sbk_muatan.id_subbk",
                    "=",
                    "ak_kurikulum_sub_bks.id"
                )
                ->leftJoin(
                    "ak_muatan",
                    "ak_muatan.kdmuatan",
                    "=",
                    "gabung_sbk_muatan.kdmuatan"
                )
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->distinct()
                ->paginate(10);
            $kdkurikulum = DB::table("ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 2) {
            $akKurikulumSubBk = DB::table('ak_kurikulum_sub_bks')
                ->select("ak_kurikulum_sub_bks.*", "ak_kurikulum_bks.bahan_kajian as ak_bk", "ak_kurikulum_bks.kode_bk as ak_kdbk", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun", "jenismuatan", "gabung_sbk_muatan.id as sbmid")
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
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->leftJoin(
                    "gabung_sbk_muatan",
                    "gabung_sbk_muatan.id_subbk",
                    "=",
                    "ak_kurikulum_sub_bks.id"
                )
                ->leftJoin(
                    "ak_muatan",
                    "ak_muatan.kdmuatan",
                    "=",
                    "gabung_sbk_muatan.kdmuatan"
                )
                ->where('ak_kurikulum.kdkurikulum', 67)
                ->distinct()
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->where('kdkurikulum', 67)
                ->get();
        } else {
            $akKurikulumSubBk = DB::table('ak_kurikulum_sub_bks')
                ->select("ak_kurikulum_sub_bks.*", "ak_kurikulum_bks.bahan_kajian as ak_bk", "ak_kurikulum_bks.kode_bk as ak_kdbk", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun", "jenismuatan", "gabung_sbk_muatan.id as sbmid")
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
                ->leftJoin(
                    "gabung_sbk_muatan",
                    "gabung_sbk_muatan.id_subbk",
                    "=",
                    "ak_kurikulum_sub_bks.id"
                )
                ->leftJoin(
                    "ak_muatan",
                    "ak_muatan.kdmuatan",
                    "=",
                    "gabung_sbk_muatan.kdmuatan"
                )
                ->distinct()
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();
        }

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }

        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $akKurikulumSubBk = DB::table('ak_kurikulum_sub_bks')
                    ->select("ak_kurikulum_sub_bks.*", "ak_kurikulum_bks.bahan_kajian as ak_bk", "ak_kurikulum_bks.kode_bk as ak_kdbk", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun", "jenismuatan", "gabung_sbk_muatan.id as sbmid")
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
                    ->leftJoin(
                        "gabung_sbk_muatan",
                        "gabung_sbk_muatan.id_subbk",
                        "=",
                        "ak_kurikulum_sub_bks.id"
                    )
                    ->leftJoin(
                        "ak_muatan",
                        "ak_muatan.kdmuatan",
                        "=",
                        "gabung_sbk_muatan.kdmuatan"
                    )
                    ->where("ak_kurikulum.isObe", '=', 1)
                    ->where("kurikulum", "=", $request->filter)
                    ->orderBy('id', 'asc')
                    ->paginate(10);
            }
        }

        return view('pages.subBahanKajian.index', compact('akKurikulumSubBk', 'kdkurikulum'));
    }

    // method sbk create
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


        $muatan = ak_muatan::all();

        return view('pages.subBahanKajian.create', compact('akKurikulumBk', 'akKurikulum', 'muatan'));
    }

    // method sbk store
    public function store(Request $request)
    {
        $request->validate([
            'kode_subbk',
            'sub_bk',
        ]);

        $subbk = ak_kurikulum_sub_bk::create([
            'kode_subbk' => $request->kode_subbk,
            'sub_bk' => $request->sub_bk,
            'referensi' => $request->referensi,
            'kdbk' => $request->bahan_kajian,
            'kdkurikulum' => $request->unit
        ]);

        $subbk->SBKtoMuatan()->attach($request->input('kdmuatan'));

        return redirect()->route('sub-bk.index')->with('success', 'Sub Bahan Kajian berhasil ditambah');
    }

    // method sbk edit
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

        $muatan = ak_muatan::all();
        return view('pages.subBahanKajian.edit', compact('subBkEdit', 'akKurikulumBk', 'muatan'));
    }

    // method sbk update
    public function update(Request $request, int $id)
    {
        $muatanSelect = [];
        if ($request->has('kdmuatan')) {
            foreach ($request->input("kdmuatan") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($muatanSelect, $value);
                }
            }
        }

        $subBkEdit = ak_kurikulum_sub_bk::findOrFail($id);

        $subBkEdit->update([
            'kode_subbk' => $request->kode_subbk,
            'sub_bk' => $request->sub_bk,
            'referensi' => $request->referensi,
            'kdbk' => $request->bahan_kajian,
            'id' => $request->bahan_kajian
        ]);

        if (count($muatanSelect) > 0) {
            $subBkEdit->SBKtoMuatan()->sync($muatanSelect);
        } else {
            $subBkEdit->SBKtoMuatan()->detach();
        }

        return redirect()->route('sub-bk.index')->with('success', 'Sub BK Berhasil Disunting');
    }

    // method sbk delete
    public function delete(int $id)
    {
        $subbk = ak_kurikulum_sub_bk::findOrFail($id);
        if (!$subbk) {
            return abort(404);
        }


        $subbk->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }
}
