<?php

namespace App\Http\Controllers;

use App\Models\ak_pengalamanmahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pengalamanMahasiswaController extends Controller
{
    // method pengelaman mahasiswa index
    public function indexPengalamanMahasiswa()
    {
        $pengalamanMahasiswa = DB::table('ak_pengalamanmahasiswa')
            ->select('ak_pengalamanmahasiswa.*')
            ->paginate(10);

        return view('pages.pengalamanMahasiswa.index', compact('pengalamanMahasiswa'));
    }

    // method pengelaman mahasiswa store
    public function storePengalamanMahasiswa(Request $request)
    {
        $request->validate([
            'pengalaman_mahasiswa'
        ]);

        ak_pengalamanmahasiswa::create([
            'pengalaman_mahasiswa' => $request->pengalaman_mahasiswa
        ]);

        return redirect()->route('index.pengalaman')->with('success', 'Pengalaman Mahasiswa Berhasil di Tambah');
    }

    // method pengelaman mahasiswa delete
    public function delete(int $id)
    {
        $pengalamanMahasiswa = ak_pengalamanmahasiswa::findOrFail($id);
        if (!$pengalamanMahasiswa) {
            return abort(404);
        }

        // return dd($pl);

        $pengalamanMahasiswa->delete();
        return redirect(url()->previous())->with('success', 'sukses di-hapus');
    }
}
