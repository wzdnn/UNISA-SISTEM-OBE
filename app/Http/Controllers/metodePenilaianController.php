<?php

namespace App\Http\Controllers;

use App\Models\metode_penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class metodePenilaianController extends Controller
{
    //

    public function metodePenilaian()
    {
        $metopen = DB::table('metode_penilaians')
            ->select('metode_penilaians.*')
            ->paginate(10);

        return view('pages.metopen.metodePenilaian', compact('metopen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_penilaian'
        ]);

        metode_penilaian::create([
            'metode_penilaian' => $request->metode_penilaian
        ]);

        return redirect()->route('metopen')->with('success', 'Metode Penilaian Berhasil ditambah');
    }

    public function delete(int $id)
    {
        $metopen = metode_penilaian::findOrFail($id);

        if (!$metopen) {
            return abort(404);
        }

        // return dd($pl);

        $metopen->delete();
        return redirect(url()->previous())->with('success', 'Metode Penilaian berhasil dihapus');
    }
}
