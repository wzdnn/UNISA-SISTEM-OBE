<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_bidang_ilmu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bidangIlmuController extends Controller
{
    // method bidang ilmu index
    public function indexBidangIlmu()
    {
        $bidil = DB::table('ak_kurikulum_bidang_ilmus')
            ->select('ak_kurikulum_bidang_ilmus.*')
            ->paginate(10);

        return view('pages.bidangIlmu.index', compact('bidil'));
    }

    // method bidang ilmu store
    public function storeBidangIlmu(Request $request)
    {
        $request->validate([
            'bidang_ilmu'
        ]);

        ak_kurikulum_bidang_ilmu::create([
            'bidang_ilmu' => $request->bidang_ilmu
        ]);

        return redirect()->route('index.bidil')->with('success', 'Bidang Ilmu Berhasil di Tambah');
    }

    // method bidang ilmu delete
    public function delete(int $id)
    {
        $bidil = ak_kurikulum_bidang_ilmu::findOrFail($id);
        if (!$bidil) {
            return abort(404);
        }

        // return dd($pl);

        $bidil->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }
}
