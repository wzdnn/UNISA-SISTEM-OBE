<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_cpmk;
use App\Models\ak_kurikulum_sub_bk;
use App\Models\ak_matakuliah;
use App\Models\gabung_matakuliah_subbk;
use App\Models\gabung_subbk_cpmk;
use App\Models\mk_sub_bk;
use App\Models\rekomendasisks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

use function Laravel\Prompts\select;

class ak_matakuliah_controller extends Controller
{

    public function mkIndex(Request $request)
    {

        if (auth()->user()->kdunit == 100 || auth()->user()->kdunit == 0 || auth()->user()->kdunit == 42) {
            $matakuliah = ak_matakuliah::with('MKtoSub_bk.SBKtoidCPMK', 'MKtoSub_bk.getSBKtoidCPMK', 'GetAllidSubBK')
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->where("ak_kurikulum.isObe", '=', 1)
                ->orderBy('kdmatakuliah', 'asc')
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } else {
            $matakuliah = ak_matakuliah::with('MKtoSub_bk.SBKtoidCPMK', 'MKtoSub_bk.getSBKtoidCPMK', 'GetAllidSubBK')
                ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                ->where("ak_kurikulum.isObe", '=', 1)
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->orderBy('kdmatakuliah', 'asc')
                ->paginate(10);

            $kdkurikulum = DB::table("ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();
        }



        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }



        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $matakuliah = ak_matakuliah::with('MKtoSub_bk.SBKtoidCPMK', 'MKtoSub_bk.getSBKtoidCPMK', 'GetAllidSubBK')
                    ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
                    ->where("ak_kurikulum.isObe", '=', 1)
                    ->where("kurikulum", "=", $request->filter)
                    ->orderBy('kdmatakuliah', 'asc')
                    ->paginate(10);
            }
        }


        // return dd($matakuliah);

        return view('pages.matakuliah.index', compact('matakuliah', 'kdkurikulum'));
    }

    // tambah data
    public function mkCreate()
    {
        $ak_kurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();

        $SBK = DB::table('ak_kurikulum_sub_bks')
            ->select(['id', 'kode_subbk', 'sub_bk'])
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_sub_bks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        return view('pages.matakuliah.create', compact('ak_kurikulum', 'SBK'));
    }

    // method post tambah data
    public function mkStore(Request $request)
    {
        $request->validate([
            'semester'
        ]);

        $matakuliah = ak_matakuliah::create([
            'kodematakuliah' => $request->kodematakuliah,
            'matakuliah' => $request->matakuliah,
            'batasNilai' => $request->batasNilai,
            'kdkurikulum' => $request->unit,
            'isObe' => 1
        ]);

        $matakuliah->MKtoSBKinput()->attach($request->input('kdsubbk'));

        // return dd($matakuliah);


        return redirect()->route('index.mk')->with('success', 'Matakuliah berhasih ditambahkan');
    }

    /**
     * New start
     * 
     * gabungan matakuliah dengan subbk
     */
    public function subbkDetail(int $id)
    {
        $rekomendasiSKS = DB::select('call sistem_obe.rekomendasi_sks(?, 144, ?)', [Auth::user()->kdunit, $id]);

        $mkSubBk = ak_matakuliah::with('MKtoSub_bk')->findOrFail($id);

        // return dd($mkSubBk);

        // return dd($rekomendasiSKS);

        return view('pages.matakuliah.detail2', compact('mkSubBk', 'rekomendasiSKS'));
    }

    public function postsubbkDetail(int $id, Request $request)
    {
        $request->validate([
            'kodematakuliah' => 'nullable',
            'matakuliah' => 'nullable',
            'mk_singkat' => 'nullable',
        ]);

        // return dd($request->all());

        try {
            // $subbk = mk_sub_bk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->first();

            $mkSubBk = ak_matakuliah::where('kdmatakuliah', '=', $id)->first();

            $mkSubBk->kodematakuliah = $request->input('kodematakuliah');
            $mkSubBk->matakuliah = $request->input('matakuliah');
            $mkSubBk->mk_singkat = $request->input('mk_singkat');
            $mkSubBk->sks = $request->input('sks');
            $mkSubBk->batasNilai = $request->input('batasNilai');

            $mkSubBk->save();

            return redirect()->back()->with('success', 'berhasil update data Matakuliah');
        } catch (Throwable $th) {

            return redirect()->back()->with('failed', 'gagal update data Matakuliah. Error: ' . $th->getMessage());
        }
    }

    public function kelolaSubBK(int $id)
    {
        $mkSubBk = ak_matakuliah::where('kdmatakuliah', '=', $id)->with('GetAllidSubBK')->first();
        // $subbk = ak_kurikulum_sub_bk::all();

        $subbk = ak_kurikulum_sub_bk::with('SBKtoMK')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_sub_bks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $subbkSelect = [];
        foreach ($mkSubBk->GetAllidSubBK as $item) {
            array_push($subbkSelect, $item->ak_kurikulum_sub_bk_id);
        }

        // return dd($subbkSelect, $subbk);

        return view('pages.matakuliah.subbk', compact('subbk', 'subbkSelect', 'id'));
    }

    public function postkelolaSubBK(int $id, Request $request)
    {
        $subkSelect = [];
        // validate
        if ($request->has('subbk')) {
            foreach ($request->input("subbk") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($subkSelect, $value);
                }
            }
        }

        try {
            $matkul = ak_matakuliah::where("kdmatakuliah", "=", $id)->with("MKtoSub_bk")->first();

            DB::beginTransaction();
            if (count($subkSelect) > 0) {
                $matkul->MKtoSub_bk()->sync($subkSelect);
            } else {
                $matkul->MKtoSub_bk()->detach();
            }

            DB::commit();
            return redirect()->back()->with("success", "berhasil update Sub BK pada Matkul");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("failed", "gagal update Sub BK pada Matkul" . $th->getMessage());
        }
    }

    // detail sub bk dan cpmk
    public function subbkCPMK(int $id, int $sub)
    {
        $subbk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('subbk', 'cpmks')->first();

        if (!$subbk) {
            return abort(404);
        }
        // return dd($subbk);

        return view('pages.matakuliah.detail-subbk', compact('id', 'sub', 'subbk'));
    }

    public function postsubbkSKS(int $id, int $sub, Request $request)
    {
        $request->validate([
            'pokok_bahasan' => 'nullable',
            'kuliah' => ['nullable', 'numeric'],
            'tutorial' => ['nullable', 'numeric'],
            'seminar' => ['nullable', 'numeric'],
            'praktikum' => ['nullable', 'numeric'],
            'skill_lab' => ['nullable', 'numeric'],
            'field_lab' => ['nullable', 'numeric'],
            'praktik' => ['nullable', 'numeric']
        ]);

        try {
            $subbk = mk_sub_bk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->first();

            $subbk->pokok_bahasan = $request->input('pokok_bahasan');
            $subbk->kuliah = $request->input('kuliah');
            $subbk->tutorial = $request->input('tutorial');
            $subbk->seminar = $request->input('seminar');
            $subbk->praktikum = $request->input('praktikum');
            $subbk->skill_lab = $request->input('skill_lab');
            $subbk->field_lab = $request->input('field_lab');
            $subbk->praktik = $request->input('praktik');

            $subbk->save();

            return redirect()->back()->with('success', 'berhasil update SKS');
        } catch (Throwable $th) {

            return redirect()->back()->with('failed', 'gagal update SKS. Error: ' . $th->getMessage());
        }
    }

    public function kelolacpmk(int $id, int $sub)
    {
        $subbkCpmk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('cpmks')->first();

        $cpmk = ak_kurikulum_cpmk::all();
        $cpmk = ak_kurikulum_cpmk::with('CPMKtoCPL')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpmks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $subbk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('subbk', 'cpmks')->first();

        $cpmkSelected = [];
        foreach ($subbkCpmk->cpmks as $item) {
            array_push($cpmkSelected, $item->id);
        }

        return view('pages.matakuliah.cpmk', compact('id', 'sub', 'cpmk', 'cpmkSelected', 'subbk'));
    }

    /**
     * New last
     * 
     * post CPMK ke SUB BK
     */
    public function postkelolacpmk(int $id, int $sub, Request $request)
    {
        $cpmkSelect = [];
        // validate
        if ($request->has('cpmk')) {
            foreach ($request->input("cpmk") as $key => $value) {
                if (!is_numeric($value)) {
                    return redirect()->back()->with("failed", "inputan tidak valid");
                } else {
                    array_push($cpmkSelect, $value);
                }
            }
        }

        try {
            $subbkCpmk = gabung_matakuliah_subbk::where('kdmatakuliah', '=', $id)->where('id', '=', $sub)->with('cpmks')->first();
            DB::beginTransaction();
            if (count($cpmkSelect) > 0) {
                $subbkCpmk->cpmks()->sync($cpmkSelect);
            } else {
                $subbkCpmk->cpmks()->detach();
            }
            DB::commit();
            return redirect()->back()->with('success', 'sukses update CPMK');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("failed", "gagal update" . $th->getMessage());
        }
    }

    public function subbkEdit(int $id)
    {
        $sbkEdit = DB::table('ak_matakuliah_ak_kurikulum_sub_bk')
            ->where('ak_kurikulum_sub_bk_id', '=', $id)
            ->get();

        // return dd($sbkEdit);
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
        $cpmk = DB::table('ak_kurikulum_cpmks')
            ->join(
                "ak_kurikulum",
                "ak_kurikulum.kdkurikulum",
                "=",
                "ak_kurikulum_cpmks.kdkurikulum"
            )
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();
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
