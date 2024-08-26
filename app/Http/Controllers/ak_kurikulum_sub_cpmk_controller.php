<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpmk;
use App\Models\ak_kurikulum_sub_cpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ak_kurikulum_sub_cpmk_controller extends Controller
{
    //

    public function index()
    {
        $sub_cpmk = ak_kurikulum_sub_cpmk::join('ak_kurikulum_cpmks', 'ak_kurikulum_cpmks.id', 'ak_kurikulum_sub_cpmk.kdcpmk')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', 'ak_kurikulum_sub_cpmk.kdkurikulum')
            ->paginate(10);

        $kurikulum = DB::table("ak_kurikulum")
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->where("isObe", "=", 1)
            ->get();


        // dd($sub_cpmk);
        return view('pages.subCpmk.index', compact('sub_cpmk', 'kurikulum'));
    }

    public function create()
    {

        $cpmk = DB::table('ak_kurikulum_cpmks')
            ->join("ak_kurikulum", "ak_kurikulum.kdkurikulum", "ak_kurikulum_cpmks.kdkurikulum")
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $kurikulum = DB::table('ak_kurikulum')
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();

        return view('pages.subCpmk.create', compact('cpmk', 'kurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_subcpmk',
            'sub_cpmk',
        ]);

        ak_kurikulum_sub_cpmk::create([
            'kode_subcpmk' => $request->kode_subcpmk,
            'sub_cpmk' => $request->sub_cpmk,
            'kdcpmk' => $request->cpmk,
            'kdkurikulum' => $request->unit

        ]);

        return redirect()->back()->with('success', 'berhasil menambah data');
    }

    public function edit(int $id)
    {

        $sub_cpmk = ak_kurikulum_sub_cpmk::findOrFail($id);

        $cpmk = DB::table('ak_kurikulum_cpmks')
            ->join("ak_kurikulum", "ak_kurikulum.kdkurikulum", "ak_kurikulum_cpmks.kdkurikulum")
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $kurikulum = DB::table('ak_kurikulum')
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();

        return view('pages.subCpmk.edit', compact('sub_cpmk', 'cpmk', 'kurikulum'));
    }

    public function update(Request $request, int $id)
    {
        $subCpmkEdit = ak_kurikulum_sub_cpmk::findOrFail($id);

        $subCpmkEdit->update([
            'kode_subcpmk' => $request->kode_subcpmk,
            'sub_cpmk' => $request->sub_cpmk,
            'kdcpmk' => $request->cpmk,
            'kdkurikulum' => $request->unit
        ]);

        return redirect()->route('subcpmk.index');
    }

    public function delete(int $id)
    {
        $subcpmk = ak_kurikulum_sub_cpmk::findOrFail($id);

        $subcpmk->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data');
    }
}
