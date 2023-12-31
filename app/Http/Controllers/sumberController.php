<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_sumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sumberController extends Controller
{
    //
    public function indexSumber()
    {
        $sumber = DB::table('ak_kurikulum_sumbers')
            ->select('ak_kurikulum_sumbers.*')
            ->paginate(10);

        return view('pages.sumber.index', compact('sumber'));
    }

    public function storeSumber(Request $request)
    {
        $request->validate([
            'sumber'
        ]);

        ak_kurikulum_sumber::create([
            'sumber' => $request->sumber
        ]);

        return redirect()->route('index.sumber')->with('success', 'sumber Berhasil di Tambah');
    }

    public function delete(int $id)
    {
        $sumber = ak_kurikulum_sumber::findOrFail($id);
        if (!$sumber) {
            return abort(404);
        }

        // return dd($pl);

        $sumber->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }
}
