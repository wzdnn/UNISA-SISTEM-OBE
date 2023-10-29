<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_pl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_pl_Controller extends Controller
{
    //

    public function index()
    {
        // $akKurikulumPl = ak_kurikulum_pl::all();

        $akKurikulumPl = DB::table('ak_kurikulum_pls')
            ->select("ak_kurikulum_pls.*", "ak_kurikulum.kdkurikulum", "ak_kurikulum.kurikulum", "ak_kurikulum.tahun")
            ->leftJoin("ak_kurikulum", "ak_kurikulum_pls.kdkurikulum", "=", "ak_kurikulum.kdkurikulum")
            ->where("ak_kurikulum.kdunitkerja", "=", Auth::user()->kdunit)
            ->orWhere("ak_kurikulum.kdunitkerja", '=', 0)
            ->orderBy(('ak_kurikulum_pls.id'))
            ->get();


        return view('pages.profileLulusan.index', compact('akKurikulumPl'));
    }

    public function create()
    {
        $unit = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();
        return view('pages.profileLulusan.create', compact('unit'));
    }

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

    public function edit(int $id)
    {
        $plEdit = ak_kurikulum_pl::findOrFail($id);
        return view('pages.profileLulusan.edit', compact('plEdit'));
    }

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

    public function delete(int $id)
    {
        $pl = ak_kurikulum_pl::findOrFail($id);
        if (!$pl) {
            return abort(404);
        }

        // return dd($pl);

        $pl->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }
}
