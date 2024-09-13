<?php

namespace App\Http\Controllers;

use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_dosen_pelaporan;
use App\Models\ak_matakuliah_dosen_utama;
use App\Models\ak_strukturprogram;
use App\Models\ak_tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class strukturProgram_controller extends Controller
{
    // Struktur Program MK
    public function strukturProgramIndex(Request $request)
    {

        $kurikulum = DB::table("ak_kurikulum")
            ->where("isObe", "=", 1)
            ->get();

        // $strukturProgram = ak_strukturprogram::all();

        $filter = ak_tahunakademik::where("isaktif", 1)->orderBy("kdtahunakademik", "asc")->get();
        $filterLatest = $filter->last();
        $kelompok = $filter->groupBy("kdtahunakademik")->toArray();

        $filter = [
            "latest" => $filterLatest->kdtahunakademik,
            "filter" => array_keys($kelompok)

        ];


        if (auth()->user()->kdunit == 42) {
            $strukturprogram = ak_strukturprogram::with('struktur_utama.person_utama.utama_dosen', 'struktur_pelaporan.person_pelaporan.pelaporan_dosen')
                ->select("ak_strukturprogram.*", "ak_strukturprogram.keterangan as ket", "kodematakuliah", "matakuliah", "tahunakademik", "kurikulum")
                ->join('ak_matakuliah as mk', 'mk.kdmatakuliah', 'ak_strukturprogram.kdmatakuliah')
                ->join('ak_kurikulum as kur', 'kur.kdkurikulum', 'ak_strukturprogram.kdkurikulum')
                ->join('ak_tahunakademik as tahunakademik', 'tahunakademik.kdtahunakademik', 'ak_strukturprogram.kdtahunakademik')
                ->when($request->input('filter-tahun') != null or $request->input('filter-tahun') != null, function ($query) use ($request) {
                    $query->where("ak_strukturprogram.kdtahunakademik", $request->input('filter-tahun'));
                })
                ->when($request->input('filter-kurikulum') != null or $request->input('filter-kurikulum') != null, function ($query) use ($request) {
                    $query->where("ak_strukturprogram.kdkurikulum", $request->input('filter-kurikulum'));
                })
                ->paginate(10);
            // ->get();
            // ->first();

            $kurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();


            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();
        } elseif (auth()->user()->leveling == 2) {
            $strukturprogram = ak_strukturprogram::with('struktur_utama.person_utama.utama_dosen', 'struktur_pelaporan.person_pelaporan.pelaporan_dosen')
                ->select("ak_strukturprogram.*", "ak_strukturprogram.keterangan as ket", "kodematakuliah", "matakuliah", "tahunakademik", "kurikulum")
                ->join('ak_matakuliah as mk', 'mk.kdmatakuliah', 'ak_strukturprogram.kdmatakuliah')
                ->join('ak_kurikulum as kur', 'kur.kdkurikulum', 'ak_strukturprogram.kdkurikulum')
                ->join('ak_tahunakademik as tahunakademik', 'tahunakademik.kdtahunakademik', 'ak_strukturprogram.kdtahunakademik')
                ->where("kur.kdkurikulum", 67)
                ->when($request->input('filter-tahun') != null or $request->input('filter-tahun') != null, function ($query) use ($request) {
                    $query->where("ak_strukturprogram.kdtahunakademik", $request->input('filter-tahun'));
                })
                ->when($request->input('filter-kurikulum') != null or $request->input('filter-kurikulum') != null, function ($query) use ($request) {
                    $query->where("ak_strukturprogram.kdkurikulum", $request->input('filter-kurikulum'));
                })
                ->paginate(10);
            // ->get();
            // ->first();

            $kurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->where("ak_kurikulum.kdkurikulum", 67)
                ->get();


            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();
        } else {
            $strukturprogram = ak_strukturprogram::with('struktur_utama.person_utama.utama_dosen', 'struktur_pelaporan.person_pelaporan.pelaporan_dosen')
                ->select("ak_strukturprogram.*", "ak_strukturprogram.keterangan as ket", "kodematakuliah", "matakuliah", "tahunakademik", "kurikulum")
                ->join('ak_matakuliah as mk', 'mk.kdmatakuliah', 'ak_strukturprogram.kdmatakuliah')
                ->join('ak_kurikulum as kur', 'kur.kdkurikulum', 'ak_strukturprogram.kdkurikulum')
                ->join('ak_tahunakademik as tahunakademik', 'tahunakademik.kdtahunakademik', 'ak_strukturprogram.kdtahunakademik')
                ->where("kur.kdunitkerja", Auth::user()->kdunit)
                ->when($request->input('filter-tahun') != null or $request->input('filter-tahun') != null, function ($query) use ($request) {
                    $query->where("ak_strukturprogram.kdtahunakademik", $request->input('filter-tahun'));
                })
                ->when($request->input('filter-kurikulum') != null or $request->input('filter-kurikulum') != null, function ($query) use ($request) {
                    $query->where("ak_strukturprogram.kdkurikulum", $request->input('filter-kurikulum'));
                })
                ->paginate(10);
            // ->get();
            // ->first();


            $kurikulum = DB::table("ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();
        }
        // dd($strukturprogram);

        return view('pages.detailMatakuliah.strukturProgramIndex', compact('filter', 'kurikulum', 'strukturprogram', 'tahunAkademik', 'kurikulum'));
    }

    public function strukturProgramCreate()
    {

        $kurikulum = DB::table("ak_kurikulum")
            ->where("isObe", "=", 1)
            ->where("kdunitkerja", Auth::user()->kdunit)
            ->get();

        $filter = ak_tahunakademik::where("isaktif", 1)->orderBy("kdtahunakademik", "desc")->first();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();

        $matakuliah = ak_matakuliah::join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', 'ak_matakuliah.kdkurikulum')
            ->where("kdunitkerja", Auth::user()->kdunit)->get();

        $dosen1 = DB::table('simptt.ak_dosen as ad')
            ->join('simptt.pt_person as pp', "pp.kdperson", "=", "ad.kdperson")
            ->orderBy('namalengkap', 'asc')
            ->get();

        $dosen2 = DB::table('simptt.ak_dosen as ad')
            ->join('simptt.pt_person as pp', "pp.kdperson", "=", "ad.kdperson")
            ->orderBy('namalengkap', 'asc')
            ->get();

        // return dd($tahunAkademik);

        return view('pages.detailMatakuliah.createStrukturProgram', compact('filter', 'tahunAkademik', 'kurikulum', 'matakuliah', 'dosen1', 'dosen2'));
    }


    public function strukturProgramStore(Request $request)
    {

        $request->validate([
            'teori'
        ]);

        $struktur = ak_strukturprogram::create([
            'kdmatakuliah' => $request->kdmatakuliah,
            'keterangan' => $request->keterangan,
            'teori' => $request->teori,
            'pertemuan_kt' => $request->pertemuan_kt,
            'tutorial' => $request->tutorial,
            'pertemuan_kp' => $request->pertemuan_kp,
            'seminar' => $request->seminar,
            'pertemuan_s' => $request->pertemuan_s,
            'praktikum' => $request->praktikum,
            'pertemuan_p' => $request->pertemuan_p,
            'praktik' => $request->praktik,
            'pertemuan_pr' => $request->pertemuan_pr,
            'belajar_mandiri' => $request->belajar_mandiri,
            'pertemuan_bm' => $request->pertemuan_bm,
            'skill_lab' => $request->skill_lab,
            'pertemuan_sl' => $request->pertemuan_sl,
            'studio' => $request->studio,
            'pertemuan_studio' => $request->pertemuan_studio,
            'kdkurikulum' => $request->kurikulum,
            'kdtahunakademik' => $request->tahunakademik
        ]);

        foreach ($request->input('dosen1') as $dosenUtama) {
            DB::table('ak_matakuliah_dosen_utama')->insert([
                "kdstrukturprogram" => $struktur->kdstrukturprogram,
                "kdperson" => $dosenUtama
            ]);
        }

        foreach ($request->input('dosen2') as $dosenPelapor) {
            DB::table('ak_matakuliah_dosen_pelaporan')->insert([
                "kdstrukturprogram" => $struktur->kdstrukturprogram,
                "kdperson" => $dosenPelapor
            ]);
        }

        // dd($struktur);
        return redirect()->back()->with('success', 'berhasil menambahkan struktur Program');
    }

    public function strukturProgramDelete(int $id)
    {
        $struktur = ak_strukturprogram::findOrFail($id);

        $dosenUtama = ak_matakuliah_dosen_utama::where('kdstrukturprogram', $id)->get();

        $dosenPelaporan = ak_matakuliah_dosen_pelaporan::where('kdstrukturprogram', $id)->get();

        $struktur->delete();

        foreach ($dosenUtama as $du) {

            $du->delete();
        }

        foreach ($dosenPelaporan as $dp) {

            $dp->delete();
        }

        return redirect()->back()->with('success', 'Berhasil menghapus struktur program');
    }

    public function strukturProgramEdit(int $id)
    {

        $strukturProgram = ak_strukturprogram::where('kdstrukturprogram', $id)->first();

        $kurikulum = DB::table("ak_kurikulum")
            ->where("isObe", "=", 1)
            ->where("kdunitkerja", Auth::user()->kdunit)
            ->get();

        $filter = ak_tahunakademik::where("isaktif", 1)->orderBy("kdtahunakademik", "desc")->first();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();

        $matakuliah = ak_matakuliah::join('ak_kurikulum', 'ak_kurikulum.kdkurikulum', 'ak_matakuliah.kdkurikulum')
            ->where("kdunitkerja", Auth::user()->kdunit)->get();

        $dosen1 = DB::table('simptt.ak_dosen as ad')
            ->join('simptt.pt_person as pp', "pp.kdperson", "=", "ad.kdperson")
            ->orderBy('namalengkap', 'asc')
            ->get();

        $dosen2 = DB::table('simptt.ak_dosen as ad')
            ->join('simptt.pt_person as pp', "pp.kdperson", "=", "ad.kdperson")
            ->orderBy('namalengkap', 'asc')
            ->get();

        $sp = ak_strukturprogram::where('kdstrukturprogram', $id)->first();

        $dosenPelaporan = ak_matakuliah_dosen_pelaporan::where('ak_matakuliah_dosen_pelaporan.kdstrukturprogram', $id)->get();
        $dosenUtama = ak_matakuliah_dosen_utama::where('ak_matakuliah_dosen_utama.kdstrukturprogram', $id)->get();


        $id_Mk = [];
        $id_tahunAkademik = [];
        $id_kurikulum = [];
        $id_DUtama = [];
        $id_DPelaporan = [];

        foreach ($dosenUtama as $dataU) {
            $id_DUtama[] = $dataU->kdperson;
        }

        foreach ($dosenPelaporan as $dataP) {
            $id_DPelaporan[] = $dataP->kdperson;
        }

        if ($sp) {
            $id_Mk[] = $sp->kdmatakuliah;
            $id_tahunAkademik[] = $sp->kdtahunakademik;
            $id_kurikulum[] = $sp->kdkurikulum;
        }


        // dd($dosenUtama);

        return view('pages.detailMatakuliah.EditStrukturProgram', compact('strukturProgram', 'filter', 'tahunAkademik', 'kurikulum', 'matakuliah', 'dosen1', 'dosen2', 'dosenUtama', 'dosenPelaporan', 'id_DUtama', 'id_DPelaporan', 'id_Mk', 'id_tahunAkademik', 'id_kurikulum'));
    }

    public function strukturProgramUpdate(Request $request, int $id)
    {
        $struktur = ak_strukturprogram::where('kdstrukturprogram', $id)->first();

        $DPelaporan = ak_matakuliah_dosen_pelaporan::where('ak_matakuliah_dosen_pelaporan.kdstrukturprogram', $id)->get();

        $DUtama = ak_matakuliah_dosen_utama::where('ak_matakuliah_dosen_utama.kdstrukturprogram', $id)->get();


        $dosenU = [];
        $dosenP = [];

        if ($struktur) {
            $struktur->update([
                'kdmatakuliah' => $request->kdmatakuliah,
                'keterangan' => $request->keterangan,
                'teori' => $request->teori,
                'pertemuan_kt' => $request->pertemuan_kt,
                'tutorial' => $request->tutorial,
                'pertemuan_kp' => $request->pertemuan_kp,
                'seminar' => $request->seminar,
                'pertemuan_s' => $request->pertemuan_s,
                'praktikum' => $request->praktikum,
                'pertemuan_p' => $request->pertemuan_p,
                'praktik' => $request->praktik,
                'pertemuan_pr' => $request->pertemuan_pr,
                'belajar_mandiri' => $request->belajar_mandiri,
                'pertemuan_bm' => $request->pertemuan_bm,
                'skill_lab' => $request->skill_lab,
                'pertemuan_sl' => $request->pertemuan_sl,
                'studio' => $request->studio,
                'pertemuan_studio' => $request->pertemuan_studio,
                'kdkurikulum' => $request->kurikulum,
                'kdtahunakademik' => $request->tahunakademik
            ]);

            // Handle dosen utama updates and deletions
            $inputDosen1 = $request->input('dosen1', []);
            foreach ($DUtama as $index => $dosenUtama) {
                if (isset($inputDosen1[$index])) {
                    $dosenUtama->update([
                        'kdstrukturprogram' => $struktur->kdstrukturprogram,
                        'kdperson' => $inputDosen1[$index]
                    ]);
                } else {
                    $dosenUtama->delete();
                }
            }

            // Create new dosen utama if more are selected
            for ($i = count($DUtama); $i < count($inputDosen1); $i++) {
                ak_matakuliah_dosen_utama::create([
                    'kdstrukturprogram' => $struktur->kdstrukturprogram,
                    'kdperson' => $inputDosen1[$i]
                ]);
            }

            // Handle dosen pelaporan updates and deletions
            $inputDosen2 = $request->input('dosen2', []);
            foreach ($DPelaporan as $index => $dosenPelaporan) {
                if (isset($inputDosen2[$index])) {
                    $dosenPelaporan->update([
                        'kdstrukturprogram' => $struktur->kdstrukturprogram,
                        'kdperson' => $inputDosen2[$index]
                    ]);
                } else {
                    $dosenPelaporan->delete();
                }
            }

            // Create new dosen pelaporan if more are selected
            for ($i = count($DPelaporan); $i < count($inputDosen2); $i++) {
                ak_matakuliah_dosen_pelaporan::create([
                    'kdstrukturprogram' => $struktur->kdstrukturprogram,
                    'kdperson' => $inputDosen2[$i]
                ]);
            }
        }

        // dd($request->input('dosen1'), $request->input('dosen2'));

        return redirect()->back()->with('success', 'Data Berhasil di-Update');
    }
}
