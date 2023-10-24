<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_aspek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class aspekController extends Controller
{
    //index aspek
    public function indexAspek()
    {
        $aspek = DB::table('ak_kurikulum_aspeks')
            ->select('ak_kurikulum_aspeks.*')
            ->get();

        return view('pages.aspek.index', compact('aspek'));
    }

    public function storeAspek(Request $request)
    {
        $request->validate([
            'aspek'
        ]);

        ak_kurikulum_aspek::create([
            'aspek' => $request->aspek
        ]);

        return redirect()->route('index.aspek')->with('success', 'Aspek Berhasil di Tambah');
    }
    public function delete(int $id)
    {
        $aspek = ak_kurikulum_aspek::findOrFail($id);
        if (!$aspek) {
            return abort(404);
        }

        // return dd($pl);

        $aspek->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }
}
