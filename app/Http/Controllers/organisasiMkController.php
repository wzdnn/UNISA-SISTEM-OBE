<?php

namespace App\Http\Controllers;

use App\Models\ak_matakuliah;
use App\Models\tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class organisasiMkController extends Controller
{
    // ============================================ Organisasi Matakuliah Dimulai dari Sini ============================================ 


    // View Page Organisasi Matakuliah
    public function orgMKShow(Request $request)
    {

        // call prosedur sks & jumlah mk

        $semester_8_sks = DB::select('call sistem_obe.organisasi_mk(8,?)', [Auth::user()->kdunit]);
        $semester_7_sks = DB::select('call sistem_obe.organisasi_mk(7,?)', [Auth::user()->kdunit]);
        $semester_6_sks = DB::select('call sistem_obe.organisasi_mk(6,?)', [Auth::user()->kdunit]);
        $semester_5_sks = DB::select('call sistem_obe.organisasi_mk(5,?)', [Auth::user()->kdunit]);
        $semester_4_sks = DB::select('call sistem_obe.organisasi_mk(4,?)', [Auth::user()->kdunit]);
        $semester_3_sks = DB::select('call sistem_obe.organisasi_mk(3,?)', [Auth::user()->kdunit]);
        $semester_2_sks = DB::select('call sistem_obe.organisasi_mk(2,?)', [Auth::user()->kdunit]);
        $semester_1_sks = DB::select('call sistem_obe.organisasi_mk(1,?)', [Auth::user()->kdunit]);

        // return dd($semester_2_sks);

        //matakuliah
        $matakuliah = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where('ak_matakuliah.semester', '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();

        // return dd($matakuliah);
        $mkSelect = [];
        foreach ($matakuliah as $item) {
            array_push($mkSelect, $item);
        }

        // return dd($matakuliah);

        // copymatakuliah



        //kurikulum univ
        $kurikulumUniv = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', 100)
            ->orwhere('kdunitkerja', '=', 56)
            ->orwhere('kdunitkerja', '=', 42)
            ->where("isObe", '=', 1)
            ->get();

        //kurikulum
        $ak_kurikulum = DB::table('ak_kurikulum')
            ->select(['kdkurikulum', 'kurikulum', 'tahun'])
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->where("isObe", '=', 1)
            ->get();

        $tema8 = DB::table('temas')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'temas.kdkurikulum')
            ->where("temas.semester", '=', 8)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->get();
        $tema7 = DB::table('temas')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'temas.kdkurikulum')
            ->where("temas.semester", '=', 7)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->get();
        $tema6 = DB::table('temas')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'temas.kdkurikulum')
            ->where("temas.semester", '=', 6)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->get();
        $tema5 = DB::table('temas')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'temas.kdkurikulum')
            ->where("temas.semester", '=', 5)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->get();
        $tema4 = DB::table('temas')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'temas.kdkurikulum')
            ->where("temas.semester", '=', 4)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->get();
        $tema3 = DB::table('temas')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'temas.kdkurikulum')
            ->where("temas.semester", '=', 3)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->get();
        $tema2 = DB::table('temas')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'temas.kdkurikulum')
            ->where("temas.semester", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->get();
        $tema1 = DB::table('temas')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'temas.kdkurikulum')
            ->where("temas.semester", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->get();

        // Semester 8
        $semester8_0 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 8)
            ->where("ak_matakuliah.ispilihan", '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester8_1 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 8)
            ->where("ak_matakuliah.ispilihan", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester8_2 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 8)
            ->where("ak_matakuliah.ispilihan", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();


        // Semester 7
        $semester7_0 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 7)
            ->where("ak_matakuliah.ispilihan", '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester7_1 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 7)
            ->where("ak_matakuliah.ispilihan", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester7_2 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 7)
            ->where("ak_matakuliah.ispilihan", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();

        // Semester 6
        $semester6_0 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 6)
            ->where("ak_matakuliah.ispilihan", '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester6_1 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 6)
            ->where("ak_matakuliah.ispilihan", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester6_2 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 6)
            ->where("ak_matakuliah.ispilihan", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();

        // Semester 5
        $semester5_0 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 5)
            ->where("ak_matakuliah.ispilihan", '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester5_1 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 5)
            ->where("ak_matakuliah.ispilihan", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester5_2 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 5)
            ->where("ak_matakuliah.ispilihan", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();

        // Semester 4
        $semester4_0 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 4)
            ->where("ak_matakuliah.ispilihan", '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester4_1 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 4)
            ->where("ak_matakuliah.ispilihan", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester4_2 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 4)
            ->where("ak_matakuliah.ispilihan", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();


        // Semester 3
        $semester3_0 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 3)
            ->where("ak_matakuliah.ispilihan", '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester3_1 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 3)
            ->where("ak_matakuliah.ispilihan", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester3_2 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 3)
            ->where("ak_matakuliah.ispilihan", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();

        // Semester 2
        $semester2_0 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 2)
            ->where("ak_matakuliah.ispilihan", '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester2_1 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 2)
            ->where("ak_matakuliah.ispilihan", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester2_2 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 2)
            ->where("ak_matakuliah.ispilihan", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();


        // Semester 1
        $semester1_0 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 1)
            ->where("ak_matakuliah.ispilihan", '=', 0)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester1_1 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 1)
            ->where("ak_matakuliah.ispilihan", '=', 1)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();
        $semester1_2 = DB::table('ak_matakuliah')
            ->join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', '=', 'ak_matakuliah.kdkurikulum')
            ->where("ak_kurikulum.isObe", '=', 1)
            ->where("ak_matakuliah.semester", '=', 1)
            ->where("ak_matakuliah.ispilihan", '=', 2)
            ->where(function ($query) {
                $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                    ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
            })
            ->orderBy('kdmatakuliah', 'asc')
            ->get();

        // return dd($semester1_0, $semester1_1, $semester1_2);
        return view('pages.matakuliah.organisasiMK', compact('kurikulumUniv', 'semester_8_sks', 'semester_7_sks', 'semester_6_sks', 'semester_5_sks', 'semester_4_sks', 'semester_3_sks', 'semester_2_sks', 'semester_1_sks', 'tema1', 'tema2', 'tema3', 'tema4', 'tema5', 'tema6', 'tema7', 'tema8', 'semester1_0', 'semester1_1', 'semester1_2', 'semester2_0', 'semester2_1', 'semester2_2', 'semester3_0', 'semester3_1', 'semester3_2', 'semester4_0', 'semester4_1', 'semester4_2', 'semester5_0', 'semester5_1', 'semester5_2', 'semester6_0', 'semester6_1', 'semester6_2', 'semester7_0', 'semester7_1', 'semester7_2', 'semester8_0', 'semester8_1', 'semester8_2', 'ak_kurikulum', 'matakuliah', 'mkSelect'));
    }

    public function temaSTORE(Request $request)
    {
        tema::create([
            'tema' => $request->tema,
            'semester' => $request->semester,
            'kdkurikulum' => $request->unit
        ]);

        return redirect()->route('organisasi.mk')->with('success', 'CPMK Berhasil Ditambahkan');
    }

    public function copyMatakuliah(Request $request)
    {
        DB::select('call sistem_obe.copy_mk_univ(?,?)', [$request->unitUniv, $request->unitProdi]);

        // return dd($copyMatakuliah, 'sukses');
        return redirect()->route('organisasi.mk')->with('success', 'Matakuliah berhasil disalin');
    }

    public function semesterOrigin(int $id)
    {

        try {
            $matkul = ak_matakuliah::where('kdmatakuliah', '=', $id);

            DB::beginTransaction();
            $matkul->update([
                'semester' => 0,
                'ispilihan' => 0
            ]);
            DB::commit();

            // return dd("suskes");
            return redirect()->back()->with("success", "Berhasil Update");
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Gagal Update Semester Matakuliah", [
                "user" => Auth::user()->email,
                "method" => "POST",
                "class" => "organisasiMKController",
                "function" => "semesterOrigin",
                "error" => $th->getMessage()
            ]);

            // return dd("gagal", $th->getMessage());
            return redirect()->back()->with("error", "Gagal Update");
        }
    }



    public function kelolaMKWPOST(Request $request)
    {
        $request->validate([
            "mkselect" => ["required"],
            "semester" => ["required", "numeric"],
        ]);

        // return dd($request->all());
        try {
            DB::beginTransaction();
            foreach ($request->input("mkselect") as $key => $value) {
                $matkul = ak_matakuliah::findOrFail($value);
                $matkul->semester = $request->input("semester");
                $matkul->ispilihan = $request->input("ispilihan");
                $matkul->save();
            }
            DB::commit();

            // return dd("suskses");
            return redirect()->back()->with("success", "Berhasil update");
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Gagal Update Semester Matakuliah", [
                "user" => Auth::user()->email,
                "method" => "POST",
                "class" => "organisasiMKController",
                "function" => "kelolaMKWPOST",
                "error" => $th->getMessage()
            ]);

            return dd("gagal", $th->getMessage());
            // return redirect()->back()->with("error", "Gagal update");
        }
    }
}
