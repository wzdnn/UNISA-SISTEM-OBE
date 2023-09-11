<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ak_kurikulum_sub_bk;
use Illuminate\Support\Facades\DB;

class ak_matakuliah_controller extends Controller
{
    //
    public function matakuliahIndex()
    {
        $ak_matakuliah = DB::table('ak_matakuliah')
            ->select("ak_matakuliah.*", "ak_kurikulum.kurikulum", "ak_mk_subbk.sub_bk")
            ->leftJoin('ak_mk_subbk', 'ak_mk_subbk.kdmatakuliah', '=', 'ak_matakuliah.kdmatakuliah')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_matakuliah.kdkurikulum"
            )
            ->orderBy("ak_matakuliah.kdmatakuliah")
            ->get();

        $ak_matakuliah->map(function ($ak_matakuliah) {
            $ak_matakuliah->sub_bk = (unserialize($ak_matakuliah->sub_bk)) ? unserialize($ak_matakuliah->sub_bk) : (object) null;
        });

        $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();
        return view('pages.matakuliah.index', compact('ak_matakuliah', 'sub_bk'));
    }

    public function MapSBKShow(int $id)
    {
        $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();
        $save = DB::table('ak_mk_subbk')
            ->select('sub_bk')
            ->where('kdmatakuliah', '=', $id)->first();

        // return dd($sub_bk);
        $data = [];
        if ($save != null) {
            $save->sub_bk = (unserialize($save->sub_bk)) ? unserialize($save->sub_bk) : null;
            $data = $save->sub_bk;
        }

        $save = $data;
        // return dd($save);
        return view('pages.matakuliah.showSBK', compact('sub_bk', 'id', 'save'));
    }

    public function mkSBKMapping(Request $request, int $mk)
    {
        $dataMKSBK = array();
        if ($request->sub_bk != null) {
            foreach ($request->sub_bk as $subbk) {
                $dataMKSBK[] = $subbk;
            }
        }

        $check = DB::table('ak_mk_subbk')
            ->where('kdmatakuliah', '=', $mk)
            ->first();

        if ($check) {
            DB::table('ak_mk_subbk')
                ->where('kdmatakuliah', '=', $mk)
                ->update([
                    'sub_bk' => serialize($dataMKSBK)
                ]);
        } else {
            DB::table('ak_mk_subbk')
                ->where('kdmatakuliah', '=', $mk)
                ->insert([
                    'kdmatakuliah' => $mk,
                    'sub_bk' => serialize($dataMKSBK)
                ]);
        }
        return redirect()->route('home.matakuliah');
    }
}
