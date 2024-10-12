<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_basis_ilmu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class basisIlmuController extends Controller
{
    // method basis ilmu index
    public function indexBasisIlmu()
    {
        $basil = DB::table('ak_kurikulum_basis_ilmus')
            ->select('ak_kurikulum_basis_ilmus.*')
            ->paginate(10);

        return view('pages.basisIlmu.index', compact('basil'));
    }

    // method basis ilmu store
    public function storeBasisIlmu(Request $request)
    {
        $request->validate([
            'basis_ilmu'
        ]);

        ak_kurikulum_basis_ilmu::create([
            'basis_ilmu' => $request->basis_ilmu
        ]);

        return redirect()->route('index.basil')->with('success', 'Basis Ilmu Berhasil di Tambah');
    }

    // method basis ilmu delete
    public function delete(int $id)
    {
        $basil = ak_kurikulum_basis_ilmu::findOrFail($id);
        if (!$basil) {
            return abort(404);
        }

        // return dd($pl);

        $basil->delete();
        return redirect(url()->previous())->with('success', 'sukses hapus');
    }
}
