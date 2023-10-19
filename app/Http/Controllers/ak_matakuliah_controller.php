<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_sub_bk;
use App\Models\ak_matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class ak_matakuliah_controller extends Controller
{
    //home page 

    public function mkIndex()
    {
        $matakuliah = ak_matakuliah::with(['MKtoSBKread', 'MKtoSBKinput'])
            ->select('ak_matakuliah.*', 'ak_kurikulum.kurikulum', 'ak_kurikulum.tahun')
            ->join(
                'ak_kurikulum',
                'ak_kurikulum.kdkurikulum',
                '=',
                'ak_matakuliah.kdkurikulum'
            )
            ->where("isObe", "=", 1)
            ->orderBy('ak_matakuliah.kdmatakuliah')
            ->get();

        // return dd($matakuliah);

        return view('pages.matakuliah.index', compact('matakuliah'));
    }

    // tambah data
    public function mkCreate()
    {
        $ak_kurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum'])
            ->get();

        $SBK = DB::table('ak_kurikulum_sub_bks')
            ->select(['id', 'kode_subbk', 'sub_bk'])
            ->get();

        return view('pages.matakuliah.create', compact('ak_kurikulum', 'SBK'));
    }

    // method post tambah data
    public function mkStore(Request $request)
    {
        $request->validate([
            'kodematakuliah',
            'mk_singkat',
            'semester'
        ]);

        $matakuliah = ak_matakuliah::create([
            'kodematakuliah' => $request->kodematakuliah,
            'matakuliah' => $request->matakuliah,
            'mk_singkat' => $request->mk_singkat,
            'kdkurikulum' => $request->unit,
            'semester' => $request->semester,
            'isObe' => $request->isObe
        ]);

        $matakuliah->MKtoSBKinput()->attach($request->input('kdsubbk'));

        // return dd($matakuliah);


        return redirect()->route('index.mk')->with('success', 'Matakuliah berhasih ditambahkan');
    }

    // detail subbk
    public function subbkDetail(int $id)
    {
        $mkSubBK = DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
            ->select('ak_matakuliah_ak_kurikulum_sub_bk.*', 'subbk_cpmk.ak_kurikulum_cpmk')
            ->leftJoin('subbk_cpmk', 'subbk_cpmk.ak_kurikulum_sub_bk_id', '=', 'ak_matakuliah_ak_kurikulum_sub_bk.ak_kurikulum_sub_bk_id')
            ->where('ak_matakuliah_ak_kurikulum_sub_bk.id', '=', $id)
            ->get();

        // return dd($mkSubBK);
        $mkSubBK->map(function ($mkSubBK) {
            $mkSubBK->ak_kurikulum_cpmk = (unserialize($mkSubBK->ak_kurikulum_cpmk)) ? unserialize($mkSubBK->ak_kurikulum_cpmk) : (object) null;
        });

        $subBK = DB::table('ak_kurikulum_sub_bks')->get();

        $cpmk = DB::table('ak_kurikulum_cpmks')->get();

        // return dd($mkSubBK);

        return view('pages.matakuliah.detail', compact('mkSubBK', 'subBK', 'id', 'cpmk'));
    }

    public function subbkEdit(int $id)
    {
        $sbkEdit = DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
            ->where('ak_kurikulum_sub_bk_id', '=', $id)
            ->get();

        return dd($sbkEdit);
        return view('', compact('sbkEdit'));
    }

    public function subbkEditStore(Request $request, int $id)
    {
        $check = DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
            ->where('ak_kurikulum_sub_bk_id', '=', $id)
            ->first();

        if ($check) {
            DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
                ->where('id', '=', $id)
                ->update([
                    'pokok_bahasan' => $request->pokok_bahasan,
                    'kuliah' => $request->kuliah,
                    'tutorial' => $request->tutorial,
                    'seminar' => $request->seminar,
                    'praktikum' => $request->praktikum,
                    'skill_lab' => $request->skill_lab,
                    'field_lab' => $request->field_lab,
                    'praktik' => $request->praktik

                ]);
        } else {
            DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
                ->where('ak_kurikulum_sub_bk_id', '=', $id)
                ->insert([
                    'pokok_bahasan' => $request->pokok_bahasan,
                    'kuliah' => $request->kuliah,
                    'tutorial' => $request->tutorial,
                    'seminar' => $request->seminar,
                    'praktikum' => $request->praktikum,
                    'skill_lab' => $request->skill_lab,
                    'field_lab' => $request->field_lab,
                    'praktik' => $request->praktik

                ]);
        }

        return redirect()->route('index.mk');
    }

    // nampilinCPMK
    public function mapCPMKshow(int $id)
    {
        $cpmk = DB::table('ak_kurikulum_cpmks')->get();
        $save = DB::table('subbk_cpmk')
            ->select('ak_kurikulum_cpmk')
            ->where('ak_kurikulum_sub_bk_id', '=', $id)->first();

        // return dd($cpmk);

        $data = [];
        if ($save != null) {
            $save->ak_kurikulum_cpmk = (unserialize($save->ak_kurikulum_cpmk)) ? unserialize($save->ak_kurikulum_cpmk) : null;
            $data = $save->ak_kurikulum_cpmk;
        }

        $save = $data;

        // return dd($save);

        return view('pages.matakuliah.showCPMK', compact('cpmk', 'id', 'save'));
    }

    // mappingCPMK
    public function mappingCPMK(Request $request, int $subbk_id)
    {
        $dataSBKCPMK = array();
        if ($request->cpmk != null) {
            foreach ($request->cpmk as $cpmk) {
                $dataSBKCPMK[] = $cpmk;
            }
        }

        $check = DB::table('subbk_cpmk')
            ->where('ak_kurikulum_sub_bk_id', '=', $subbk_id)
            ->first();

        if ($check) {
            DB::table('subbk_cpmk')
                ->where('ak_kurikulum_sub_bk_id', '=', $subbk_id)
                ->update([
                    'ak_kurikulum_cpmk' => serialize($dataSBKCPMK)
                ]);
        } else {
            DB::table('subbk_cpmk')
                ->where('ak_kurikulum_sub_bk_id', '=', $subbk_id)
                ->insert([
                    'ak_kurikulum_sub_bk_id' => $subbk_id,
                    'ak_kurikulum_cpmk' => serialize($dataSBKCPMK)
                ]);
        }
        return redirect()->route('index.mk');
    }
}





// BELUM BERGUNA
//
    // public function matakuliahIndex()
    // {
    //     $ak_matakuliah = DB::table('ak_matakuliah')
    //         ->select("ak_matakuliah.*", "ak_kurikulum.kurikulum", "ak_mk_subbk.sub_bk")
    //         ->leftJoin('ak_mk_subbk', 'ak_mk_subbk.kdmatakuliah', '=', 'ak_matakuliah.kdmatakuliah')
    //         ->join(
    //             "ak_kurikulum",
    //             "ak_kurikulum.kdkurikulum",
    //             "=",
    //             "ak_matakuliah.kdkurikulum"
    //         )
    //         ->orderBy("ak_matakuliah.kdmatakuliah")
    //         ->get();

    //     $ak_matakuliah->map(function ($ak_matakuliah) {
    //         $ak_matakuliah->sub_bk = (unserialize($ak_matakuliah->sub_bk)) ? unserialize($ak_matakuliah->sub_bk) : (object) null;
    //     });

    //     $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();
    //     return view('pages.matakuliah.index', compact('ak_matakuliah', 'sub_bk'));
    // }

    // public function mkSubBKindex(int $id)
    // {
    //     $mkSubBK = DB::table('ak_mk_subbk')
    //         ->select('sub_bk')
    //         ->where('kdmatakuliah', '=', $id)
    //         ->first();

    //     $data = [];
    //     if ($mkSubBK != null) {
    //         $mkSubBK->sub_bk = (unserialize($mkSubBK->sub_bk)) ? unserialize($mkSubBK->sub_bk) : null;
    //         $data = $mkSubBK->sub_bk;
    //     }

    //     $mkSubBK = $data;

    //     // return dd($mkSubBK);

    //     $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();
    //     return view('pages.matakuliah.subBKMK', compact('mkSubBK', 'sub_bk'));
    // }

    // public function MapSBKShow(int $id)
    // {
    //     $sub_bk = DB::table('ak_kurikulum_sub_bks')->get();
    //     $save = DB::table('ak_mk_subbk')
    //         ->select('sub_bk')
    //         ->where('kdmatakuliah', '=', $id)->first();

    //     // return dd($sub_bk);
    //     $data = [];
    //     if ($save != null) {
    //         $save->sub_bk = (unserialize($save->sub_bk)) ? unserialize($save->sub_bk) : null;
    //         $data = $save->sub_bk;
    //     }

    //     $save = $data;
    //     // return dd($save);
    //     return view('pages.matakuliah.showSBK', compact('sub_bk', 'id', 'save'));
    // }

    // public function mkSBKMapping(Request $request, int $mk)
    // {
    //     $dataMKSBK = array();
    //     if ($request->sub_bk != null) {
    //         foreach ($request->sub_bk as $subbk) {
    //             $dataMKSBK[] = $subbk;
    //         }
    //     }

    //     $check = DB::table('ak_mk_subbk')
    //         ->where('kdmatakuliah', '=', $mk)
    //         ->first();

    //     if ($check) {
    //         DB::table('ak_mk_subbk')
    //             ->where('kdmatakuliah', '=', $mk)
    //             ->update([
    //                 'sub_bk' => serialize($dataMKSBK)
    //             ]);
    //     } else {
    //         DB::table('ak_mk_subbk')
    //             ->where('kdmatakuliah', '=', $mk)
    //             ->insert([
    //                 'kdmatakuliah' => $mk,
    //                 'sub_bk' => serialize($dataMKSBK)
    //             ]);
    //     }
    //     return redirect()->route('home.matakuliah');
    // }

    // public function mapCPMKSBKshow(int $id)
    // {
    //     $cpmk = DB::table('ak_kurikulum_cpmks')->get();
    //     $save = DB::table('ak_mk_subbk_cpmk')
    //         ->select('cpmk')
    //         ->where('kdmksubbk', '=', $id)->first();

    //     $data = [];
    //     if ($save != null) {
    //         $save->cpmk = (unserialize($save->cpmk)) ? unserialize($save->cpmk) : null;
    //         $data = $save->cpmk;
    //     }

    //     $save = $data;
    //     return view('', compact('cpmk', 'id', 'save'));
    // }

    // public function mapCPMKSBKstore(Request $request, int $cpmkSBK)
    // {
    //     $dataCPMKSBK = array();
    //     if ($request->cpmk != null) {
    //         foreach ($request->cpmk as $cpmk) {
    //             $dataCPMKSBK[] = $cpmk;
    //         }
    //     }

    //     $check = DB::table('ak_mk_subbk_cpmk')
    //         ->where('kdmksubbk', '=', $cpmkSBK)
    //         ->first();
    // }