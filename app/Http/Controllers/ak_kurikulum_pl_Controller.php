<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_pl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_pl_Controller extends Controller
{
    // method pl index
    public function index(Request $request)
    {
        if (auth()->user()->kdunit == 42 || auth()->user()->kdunit == 100) {
            $akKurikulumPl = DB::table('ak_kurikulum_pls')
                ->select("ak_kurikulum_pls.*", "ak_kurikulum.kdkurikulum", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
                ->leftJoin("ak_kurikulum", "ak_kurikulum_pls.kdkurikulum", "=", "ak_kurikulum.kdkurikulum")
                ->orderBy(('ak_kurikulum_pls.id'))
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 3) {
            $akKurikulumPl = DB::table('ak_kurikulum_pls')
                ->select("ak_kurikulum_pls.*", "ak_kurikulum.kdkurikulum", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
                ->leftJoin("ak_kurikulum", "ak_kurikulum_pls.kdkurikulum", "=", "ak_kurikulum.kdkurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where('puk.kdunitkerjapj', '=', Auth::user()->kdunit)
                ->orderBy(('ak_kurikulum_pls.id'))
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where("puk.kdunitkerjapj", "=", Auth::user()->kdunit)
                ->where("isObe", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 2) {
            $akKurikulumPl = DB::table('ak_kurikulum_pls')
                ->select("ak_kurikulum_pls.*", "ak_kurikulum.kdkurikulum", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
                ->leftJoin("ak_kurikulum", "ak_kurikulum_pls.kdkurikulum", "=", "ak_kurikulum.kdkurikulum")
                ->join("pt_unitkerja as puk", "puk.kdunitkerja", "=", "ak_kurikulum.kdunitkerja")
                ->where('ak_kurikulum.kdkurikulum', 67)
                ->orderBy(('ak_kurikulum_pls.id'))
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->where('kdkurikulum', 67)
                ->get();
        } else {
            $akKurikulumPl = DB::table('ak_kurikulum_pls')
                ->select("ak_kurikulum_pls.*", "ak_kurikulum.kdkurikulum", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
                ->leftJoin("ak_kurikulum", "ak_kurikulum_pls.kdkurikulum", "=", "ak_kurikulum.kdkurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->orderBy(('ak_kurikulum_pls.id'))
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->orderBy("kdkurikulum")
                ->get();
        }

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }

        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $akKurikulumPl = DB::table('ak_kurikulum_pls')
                    ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_kurikulum_pls.kdkurikulum')
                    ->join('pt_unitkerja as puk', 'puk.kdunitkerja', '=', 'ak_kurikulum.kdunitkerja')
                    ->where("ak_kurikulum.isObe", '=', 1)
                    ->where("kurikulum", "=", $request->filter)
                    ->orderBy('id', 'asc')
                    ->paginate(10);
            }
        }

        return view('pages.profileLulusan.index', compact('akKurikulumPl', 'kdkurikulum'));
    }

    // method pl create
    public function create()
    {
        $unit = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();
        return view('pages.profileLulusan.create', compact('unit'));
    }

    // method pl store
    public function store(Request $request)
    {
        $request->validate([
            'kode_pl',
            'profile_lulusan'
        ]);

        ak_kurikulum_pl::create([
            'kode_pl' => $request->kode_pl,
            'profile_lulusan' => $request->profile_lulusan,
            'deskripsi_profile' => $request->deskripsi_profile,
            'kdkurikulum' => $request->unit
        ]);

        return redirect()->route('pl.index')->with('success', 'Profile Lulusan Berhasil Ditambahkan');
    }

    // method pl edit
    public function edit(int $id)
    {
        $plEdit = ak_kurikulum_pl::findOrFail($id);
        return view('pages.profileLulusan.edit', compact('plEdit'));
    }

    // method pl update
    public function update(Request $request, int $id)
    {
        $plEdit = ak_kurikulum_pl::findOrFail($id);
        $plEdit->update([
            'kode_pl' => $request->kode_pl,
            'profile_lulusan' => $request->profile_lulusan,
            'deskripsi_profile' => $request->deskripsi_profile
        ]);

        return redirect()->route('pl.index')->with('success', 'Profile Lulusan Berhasil Diedit');
    }

    // method pl delete
    public function delete(int $id)
    {
        $pl = ak_kurikulum_pl::findOrFail($id);
        if (!$pl) {
            return abort(404);
        }

        $pl->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }
}
