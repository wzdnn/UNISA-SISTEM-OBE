<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_bk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_bk_controller extends Controller
{
    // method bk index
    public function index(Request $request)
    {
        // $akKurikulumBk = ak_kurikulum_bk::all();
        if (auth()->user()->kdunit == 42 || auth()->user()->kdunit == 100) {
            $akKurikulumBk = DB::table('ak_kurikulum_bks')
                ->select(
                    "ak_kurikulum_bks.*",
                    "ak_kurikulum_basis_ilmus.basis_ilmu as ak_basil",
                    "ak_kurikulum_bidang_ilmus.bidang_ilmu as ak_bidil",
                    "ak_kurikulum.kurikulum",
                    "ak_kurikulum.tahun"
                )
                ->join(
                    "ak_kurikulum_basis_ilmus",
                    "ak_kurikulum_basis_ilmus.id",
                    "=",
                    "ak_kurikulum_bks.kdbasil"
                )
                ->join(
                    "ak_kurikulum_bidang_ilmus",
                    "ak_kurikulum_bidang_ilmus.id",
                    "=",
                    "ak_kurikulum_bks.kdbidil"
                )
                ->join(
                    "simptt.ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_bks.kdkurikulum"
                )
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->paginate(10);

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 3) {
            $akKurikulumBk = DB::table('ak_kurikulum_bks')
                ->select(
                    "ak_kurikulum_bks.*",
                    "ak_kurikulum_basis_ilmus.basis_ilmu as ak_basil",
                    "ak_kurikulum_bidang_ilmus.bidang_ilmu as ak_bidil",
                    "ak_kurikulum.kurikulum",
                    "ak_kurikulum.tahun"
                )
                ->join(
                    "ak_kurikulum_basis_ilmus",
                    "ak_kurikulum_basis_ilmus.id",
                    "=",
                    "ak_kurikulum_bks.kdbasil"
                )
                ->join(
                    "ak_kurikulum_bidang_ilmus",
                    "ak_kurikulum_bidang_ilmus.id",
                    "=",
                    "ak_kurikulum_bks.kdbidil"
                )
                ->join(
                    "simptt.ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_bks.kdkurikulum"
                )
                ->paginate(10);

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 2) {
            $akKurikulumBk = DB::table('ak_kurikulum_bks')
                ->select(
                    "ak_kurikulum_bks.*",
                    "ak_kurikulum_basis_ilmus.basis_ilmu as ak_basil",
                    "ak_kurikulum_bidang_ilmus.bidang_ilmu as ak_bidil",
                    "ak_kurikulum.kurikulum",
                    "ak_kurikulum.tahun"
                )
                ->join(
                    "ak_kurikulum_basis_ilmus",
                    "ak_kurikulum_basis_ilmus.id",
                    "=",
                    "ak_kurikulum_bks.kdbasil"
                )
                ->join(
                    "ak_kurikulum_bidang_ilmus",
                    "ak_kurikulum_bidang_ilmus.id",
                    "=",
                    "ak_kurikulum_bks.kdbidil"
                )
                ->join(
                    "simptt.ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_bks.kdkurikulum"
                )
                ->where('ak_kurikulum.kdkurikulum', 67)
                ->paginate(10);

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where("isObe", "=", 1)
                ->where('kdkurikulum', 67)
                ->get();
        } else {
            $akKurikulumBk = DB::table('ak_kurikulum_bks')
                ->select(
                    "ak_kurikulum_bks.*",
                    "ak_kurikulum_basis_ilmus.basis_ilmu as ak_basil",
                    "ak_kurikulum_bidang_ilmus.bidang_ilmu as ak_bidil",
                    "ak_kurikulum.kurikulum",
                    "ak_kurikulum.tahun"
                )
                ->join(
                    "ak_kurikulum_basis_ilmus",
                    "ak_kurikulum_basis_ilmus.id",
                    "=",
                    "ak_kurikulum_bks.kdbasil"
                )
                ->join(
                    "ak_kurikulum_bidang_ilmus",
                    "ak_kurikulum_bidang_ilmus.id",
                    "=",
                    "ak_kurikulum_bks.kdbidil"
                )
                ->join(
                    "simptt.ak_kurikulum",
                    "ak_kurikulum.kdkurikulum",
                    "=",
                    "ak_kurikulum_bks.kdkurikulum"
                )
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->paginate(10);

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
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
                $akKurikulumBk = DB::table('ak_kurikulum_bks')
                    ->select(
                        "ak_kurikulum_bks.*",
                        "ak_kurikulum_basis_ilmus.basis_ilmu as ak_basil",
                        "ak_kurikulum_bidang_ilmus.bidang_ilmu as ak_bidil",
                        "ak_kurikulum.kurikulum",
                        "ak_kurikulum.tahun"
                    )
                    ->join(
                        "ak_kurikulum_basis_ilmus",
                        "ak_kurikulum_basis_ilmus.id",
                        "=",
                        "ak_kurikulum_bks.kdbasil"
                    )
                    ->join(
                        "ak_kurikulum_bidang_ilmus",
                        "ak_kurikulum_bidang_ilmus.id",
                        "=",
                        "ak_kurikulum_bks.kdbidil"
                    )
                    ->join(
                        "simptt.ak_kurikulum",
                        "ak_kurikulum.kdkurikulum",
                        "=",
                        "ak_kurikulum_bks.kdkurikulum"
                    )
                    ->where("ak_kurikulum.isObe", '=', 1)
                    ->where("kurikulum", "=", $request->filter)
                    ->orderBy('id', 'asc')
                    ->paginate(10);
            }
        }


        return view('pages.bahanKajian.index', compact('akKurikulumBk', 'kdkurikulum'));
    }

    // method bk create
    public function create()
    {
        $akKurikulumBasil = DB::table('ak_kurikulum_basis_ilmus')
            ->select(['id', 'basis_ilmu'])
            ->get();
        $akKurikulumBidil = DB::table('ak_kurikulum_bidang_ilmus')
            ->select(['id', 'bidang_ilmu'])
            ->get();
        $akKurikulum = DB::table('simptt.ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();
        return view('pages.bahanKajian.create', compact('akKurikulumBasil', 'akKurikulumBidil', 'akKurikulum'));
    }

    // method bk store
    public function store(Request $request)
    {
        $request->validate([
            'kode_bk',
            'bahan_kajian'
        ]);

        ak_kurikulum_bk::create([
            'kode_bk' => $request->kode_bk,
            'bahan_kajian' => $request->bahan_kajian,
            'kdbasil' => $request->basil,
            'kdbidil' => $request->bidil,
            'kdkurikulum' => $request->unit
        ]);

        return redirect()->route('bk.index')->with('success', 'Bahan Kajian berhasil ditambah');
    }

    // method bk delete
    public function delete(int $id)
    {
        $bk = ak_kurikulum_bk::findOrFail($id);
        if (!$bk) {
            return abort(404);
        }

        // return dd($pl);

        $bk->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }

    // method bk edit
    public function edit(int $id)
    {
        $akKurikulumBasil = DB::table('ak_kurikulum_basis_ilmus')
            ->select(['id', 'basis_ilmu'])
            ->get();
        $akKurikulumBidil = DB::table('ak_kurikulum_bidang_ilmus')
            ->select(['id', 'bidang_ilmu'])
            ->get();

        $bkEdit = ak_kurikulum_bk::findOrFail($id);

        return view('pages.bahanKajian.edit', compact('bkEdit', 'akKurikulumBasil', 'akKurikulumBidil'));
    }

    // method bk update
    public function update(Request $request, int $id)
    {
        $bkEdit = ak_kurikulum_bk::findOrFail($id);
        $bkEdit->update([
            'kode_bk' => $request->kode_bk,
            'bahan_kajian' => $request->bahan_kajian,
            'kdbasil' => $request->basil,
            'kdbidil' => $request->bidil
        ]);

        return redirect()->route('bk.index')->with('success', 'Bahan Kajian Berhasil Disunting');
    }
}
