<?php

namespace App\Http\Controllers;

use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_cpmk;
use App\Models\ak_penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class rekap_controller extends Controller
{
    public function rekapSemester(int $id, Request $request, int $semester)
    {

        if (auth()->user()->kdunit == 100 || auth()->user()->kdunit == 0) {
            $tabel = ak_matakuliah_cpmk::select("gmc.id", "metode_penilaian", "bobot", "kode_cpmk", "kode_cpl", "kdtahunakademik", "ak_matakuliah_cpmk.id", "matakuliah")
                ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_cpmk.kdmatakuliah")
                ->join("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "ak_matakuliah_cpmk.id")
                ->join("gabung_nilai_metopen as gnm", "gnm.id_gabung_metopen", "=", "gmc.id")
                ->join("ak_penilaian as ap", "ap.kdjenisnilai", "=", "gnm.kdjenisnilai")
                ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "ak_matakuliah_cpmk.id_cpmk")
                ->join("ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk", "cplcpmk.ak_kurikulum_cpmk_id", "=", "ak_matakuliah_cpmk.id_cpmk")
                ->join("ak_kurikulum_cpls as akc", "akc.id", "=", "cplcpmk.ak_kurikulum_cpl_id")
                ->join("simptt.ak_kurikulum as ak", "ak.kdkurikulum", "mk.kdkurikulum")
                ->where("kdtahunakademik", $id)
                ->where("semester", $semester)
                ->orderBy("gmc.id", "asc")
                ->orderBy("ak_matakuliah_cpmk.id", "asc")
                ->distinct()
                ->get();

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } else {
            $tabel = ak_matakuliah_cpmk::select("gmc.id", "metode_penilaian", "bobot", "kode_cpmk", "kode_cpl", "kdtahunakademik", "ak_matakuliah_cpmk.id", "matakuliah")
                ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_cpmk.kdmatakuliah")
                ->join("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "ak_matakuliah_cpmk.id")
                ->join("gabung_nilai_metopen as gnm", "gnm.id_gabung_metopen", "=", "gmc.id")
                ->join("ak_penilaian as ap", "ap.kdjenisnilai", "=", "gnm.kdjenisnilai")
                ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "ak_matakuliah_cpmk.id_cpmk")
                ->join("ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk", "cplcpmk.ak_kurikulum_cpmk_id", "=", "ak_matakuliah_cpmk.id_cpmk")
                ->join("ak_kurikulum_cpls as akc", "akc.id", "=", "cplcpmk.ak_kurikulum_cpl_id")
                ->join("simptt.ak_kurikulum as ak", "ak.kdkurikulum", "mk.kdkurikulum")
                ->where("ak.kdunitkerja", Auth::user()->kdunit)
                ->where("kdtahunakademik", $id)
                ->where("semester", $semester)
                ->orderBy("gmc.id", "asc")
                ->orderBy("ak_matakuliah_cpmk.id", "asc")
                ->distinct()
                ->get();

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();
        }

        $arrayTahun = [];
        foreach ($tahunAkademik as $data) {
            array_push($arrayTahun, $data->kdtahunakademik);
        }

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }

        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $rekapSemester = DB::select('call sistem_obe.rekap_semester(?,?,?)', [$id, $request->filter, $semester]);
            }
        }

        $rekapSemester = DB::select('call sistem_obe.rekap_semester(?,?,?)', [$id, $request->filter, $semester]);
        $rekap = json_decode(json_encode($rekapSemester), true);
        foreach ($rekap as $key => $value) {
            $loop = 1;
            foreach ($value as $urutanData => $data) {
                if ($loop <= 6) {
                    $mahasiswa[$key][] = $data;
                } else {
                    $mahasiswa[$key][6][$urutanData] = $data;
                }
                $loop++;
            }
        }

        $rekapCpmk = DB::select('call sistem_obe.rekap_semester_cpmk(?,?,?)', [$id, $request->filter, $semester]);
        $cpmk = json_decode(json_encode($rekapCpmk), true);

        $statistik = [];
        foreach ($cpmk[0] as $key => $item) {
            if (substr($key, 0, 16) == 'ketercapaiancpmk') {
                // Extract just the CPMK part, e.g., ketercapaiancpmk1 => CPMK 1
                $label = substr($key, 17);
                $statistik[] = [
                    'label' => $label,
                    'score' => number_format((float)$item, 2) // Format the score to 2 decimal places
                ];
            }
        }

        // Sort the $statistik array by the 'label' key in ascending order
        usort($statistik, function ($a, $b) {
            // Extract the numeric part from the labels to sort numerically (CPMK 1, CPMK 2, etc.)
            return intval(substr($a['label'], 5)) <=> intval(substr($b['label'], 5));
        });

        // Separate the sorted labels and scores into separate arrays
        $sortedLabels = array_column($statistik, 'label');
        $sortedScores = array_column($statistik, 'score');

        // dd($statistik);

        return view('pages.metopen.rekapSemester', [
            'statistik' => [
                'label' => $sortedLabels,
                'score' => $sortedScores
            ]
        ], compact('tahunAkademik', 'rekapSemester', 'tabel', 'mahasiswa', 'kdkurikulum', 'cpmk', 'statistik'));
    }

    public function rekapMahasiswaGet(Request $request)
    {
        $rekapMahasiswa = DB::select('call sistem_obe.rekap_cpl_mahasiswa(?,?)', [$request->nim, null]);
        $rekap = json_decode(json_encode($rekapMahasiswa), true);

        $statistik = [];
        foreach ($rekap[0] as $key => $item) {
            if (substr($key, 0, 15) == 'ketercapaiancpl') {
                // Extract just the CPMK part, e.g., ketercapaiancpl => CPMK 1
                $label = substr($key, 16);
                $statistik[] = [
                    'label' => $label,
                    'score' => number_format((float)$item, 2) // Format the score to 2 decimal places
                ];
            }
        }

        // Sort the $statistik array by the 'label' key in ascending order
        usort($statistik, function ($a, $b) {
            // Extract the numeric part from the labels to sort numerically (CPMK 1, CPMK 2, etc.)
            return intval(substr($a['label'], 5)) <=> intval(substr($b['label'], 5));
        });

        // Separate the sorted labels and scores into separate arrays
        $sortedLabels = array_column($statistik, 'label');
        $sortedScores = array_column($statistik, 'score');

        // dd($statistik);

        // dd($rekap);

        return view("pages.rekap.rekapMahasiswa", [
            'statistik' => [
                'label' => $sortedLabels,
                'score' => $sortedScores
            ]
        ], compact('rekap', 'statistik'));
    }

    public function rekap(Request $request)
    {


        $rekap = DB::table('ak_tahunakademik as ata')
            ->where("isAktif", 1)
            ->get();


        if (auth()->user()->kdunit == 100 || auth()->user()->kdunit == 0) {

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();

            $rekapTahunanIndex = DB::table("ak_mahasiswa as am")
                ->select(DB::raw('distinct left(kdtamasuk,4) as tahun'))
                ->join("simptt.ak_kurikulum as ak", "ak.kdkurikulum", "am.kdkurikulum")
                ->where("isObe", 1)
                ->orderBy('kdtamasuk', 'asc')
                ->get();
        } else {
            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();

            $rekapTahunanIndex = DB::table("ak_mahasiswa as am")
                ->select(DB::raw('distinct left(kdtamasuk,4) as tahun'))
                ->join("simptt.ak_kurikulum as ak", "ak.kdkurikulum", "am.kdkurikulum")
                ->where("ak.kdunitkerja", Auth::user()->kdunit)
                ->where("isObe", 1)
                ->orderBy('kdtamasuk', 'asc')
                ->get();
        }


        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }



        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $rekap = DB::table('ak_tahunakademik as ata')
                    ->where("isAktif", 1)
                    ->get();

                $rekapTahunanIndex = DB::table("ak_mahasiswa as am")
                    ->select(DB::raw('distinct left(kdtamasuk,4) as tahun'))
                    ->join("simptt.ak_kurikulum as ak", "ak.kdkurikulum", "am.kdkurikulum")
                    ->where("ak.kurikulum", $request->filter)
                    ->where("isObe", 1)
                    ->get();
            }
        }

        // dd($rekapTahunanIndex);
        return view('pages.rekap.index', compact('rekap', 'rekapTahunanIndex', 'kdkurikulum'));
    }

    public function indexSemester(int $id)
    {
        $tahunAkademik = DB::table('ak_tahunakademik as ata')
            ->where("isAktif", 1)
            ->where('kdtahunakademik', $id)
            ->first();

        $semester = ak_matakuliah::select('semester')->distinct()->get();

        return view("pages.rekap.index-semester", compact('semester', 'tahunAkademik'));
    }

    public function rekapTahunan(Request $request, int $id)
    {

        if (auth()->user()->kdunit == 100 || auth()->user()->kdunit == 0) {
            $tabel = ak_matakuliah_cpmk::select("gmc.id", "metode_penilaian", "bobot", "kode_cpmk", "kode_cpl", "kdtahunakademik", "ak_matakuliah_cpmk.id", "matakuliah")
                ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_cpmk.kdmatakuliah")
                ->join("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "ak_matakuliah_cpmk.id")
                ->join("gabung_nilai_metopen as gnm", "gnm.id_gabung_metopen", "=", "gmc.id")
                ->join("ak_penilaian as ap", "ap.kdjenisnilai", "=", "gnm.kdjenisnilai")
                ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
                ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "ak_matakuliah_cpmk.id_cpmk")
                ->join("ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk", "cplcpmk.ak_kurikulum_cpmk_id", "=", "ak_matakuliah_cpmk.id_cpmk")
                ->join("ak_kurikulum_cpls as akc", "akc.id", "=", "cplcpmk.ak_kurikulum_cpl_id")
                ->join("simptt.ak_kurikulum as ak", "ak.kdkurikulum", "mk.kdkurikulum")
                ->whereRaw("(kdtahunakademik = concat($id, '1') or kdtahunakademik = concat($id, '2'))")
                ->orderBy("gmc.id", "asc")
                ->orderBy("ak_matakuliah_cpmk.id", "asc")
                ->distinct()
                ->get();

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();
            $kdkurikulum = DB::table("ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();
        } else {
            // $tabel = ak_matakuliah_cpmk::select("gmc.id", "metode_penilaian", "bobot", "kode_cpmk", "kode_cpl", "kdtahunakademik", "ak_matakuliah_cpmk.id", "matakuliah")
            //     ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_cpmk.kdmatakuliah")
            //     ->join("gabung_metopen_cpmks as gmc", "gmc.id_gabung_cpmk", "=", "ak_matakuliah_cpmk.id")
            //     ->join("gabung_nilai_metopen as gnm", "gnm.id_gabung_metopen", "=", "gmc.id")
            //     ->join("ak_penilaian as ap", "ap.kdjenisnilai", "=", "gnm.kdjenisnilai")
            //     ->join("metode_penilaians as mp", "mp.id", "=", "gmc.id_metopen")
            //     ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "ak_matakuliah_cpmk.id_cpmk")
            //     ->join("ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk", "cplcpmk.ak_kurikulum_cpmk_id", "=", "ak_matakuliah_cpmk.id_cpmk")
            //     ->join("ak_kurikulum_cpls as akc", "akc.id", "=", "cplcpmk.ak_kurikulum_cpl_id")
            //     ->join("simptt.ak_kurikulum as ak", "ak.kdkurikulum", "mk.kdkurikulum")
            //     ->where("ak.kdunitkerja", Auth::user()->kdunit)
            //     ->whereRaw("(kdtahunakademik = concat($id, '1') or kdtahunakademik = concat($id, '2'))")
            //     ->orderBy("gmc.id", "asc")
            //     ->orderBy("ak_matakuliah_cpmk.id", "asc")
            //     ->distinct()
            //     ->get();

            // $tabel = ak_penilaian::select("gmc.id", "metode_penilaian", "bobot", "kode_cpmk", "kode_cpl", "krs.kdtahunakademik", "amc.id", "matakuliah")
            //     ->join("gabung_nilai_metopen as gnm", "gnm.kdjenisnilai", "ak_penilaian.kdjenisnilai")
            //     ->join("gabung_metopen_cpmks as gmc", "gmc.id", "gnm.id_gabung_metopen")
            //     ->join("metode_penilaians as mp", "mp.id", "gmc.id_metopen")
            //     ->join("ak_matakuliah_cpmk as amc", "amc.id", "gmc.id_gabung_cpmk")
            //     ->join("simptt.ak_krsnilai as krs", "krs.kdkrsnilai", "ak_penilaian.kdkrsnilai")
            //     ->join("simptt.ak_mahasiswa as mhs", "mhs.kdmahasiswa", "krs.kdmahasiswa")
            //     ->join("simptt.pt_person as pp", "pp.kdperson", "mhs.kdperson")
            //     ->join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "amc.id_cpmk")
            //     ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "amc.kdmatakuliah")
            //     ->join("simptt.ak_kurikulum as kur", "kur.kdkurikulum", "mk.kdkurikulum")
            //     ->join("ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk", "cplcpmk.ak_kurikulum_cpmk_id", "amc.id_cpmk")
            //     ->join("ak_kurikulum_cpls as cpl", "cpl.id", "cplcpmk.ak_kurikulum_cpl_id")
            //     ->where("kur.kdunitkerja", Auth::user()->kdunit)
            //     ->whereRaw("(mhs.kdtamasuk = concat($id, '1') or mhs.kdtamasuk = concat($id, '2'))")
            //     ->orderBy("amc.kdmatakuliah", "asc")
            //     ->orderBy("gmc.id", "asc")
            //     ->orderBy("cpmk.id", "asc")
            //     ->distinct()
            //     ->get();

            $tabel = DB::select('call sistem_obe.rekap_tahun_header(?,?)', [$id, Auth::user()->kdunit]);

            $tahunAkademik = DB::table('ak_tahunakademik')
                ->where("isAktif", "=", 1)
                ->get();
            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where(function ($query) {
                    $query->where("ak_kurikulum.kdunitkerja", '=', Auth::user()->kdunit)
                        ->orWhere("ak_kurikulum.kdunitkerja", '=', 0);
                })
                ->where("isObe", "=", 1)
                ->get();
        }

        // dd($tabel);

        $arrayTahun = [];
        foreach ($tahunAkademik as $data) {
            array_push($arrayTahun, $data->kdtahunakademik);
        }

        $arrayKurikulum = [];
        foreach ($kdkurikulum as $data) {
            array_push($arrayKurikulum, $data->kurikulum);
        }

        if ($request->has("filter")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $rekapTahunan = DB::select('call sistem_obe.rekap_tahunan(?,?)', [$id, $request->filter]);
            }
        }

        $rekapTahunan = DB::select('call sistem_obe.rekap_tahunan(?,?)', [$id, $request->filter]);
        $rekap = json_decode(json_encode($rekapTahunan), true);
        foreach ($rekap as $key => $value) {
            $loop = 1;
            foreach ($value as $urutanData => $data) {
                if ($loop <= 6) {
                    $mahasiswa[$key][] = $data;
                } else {
                    $mahasiswa[$key][6][$urutanData] = $data;
                }
                $loop++;
            }
        }

        $rekapCpl = DB::select('call sistem_obe.rekap_tahunan_cpl(?,?)', [$id, $request->filter]);
        $cpl = json_decode(json_encode($rekapCpl), true);

        $statistik = [];
        foreach ($cpl[0] as $key => $item) {
            if (substr($key, 0, 15) == 'ketercapaiancpl') {
                // Extract just the CPMK part, e.g., ketercapaiancpl => CPMK 1
                $label = substr($key, 16);
                $statistik[] = [
                    'label' => $label,
                    'score' => number_format((float)$item, 2) // Format the score to 2 decimal places
                ];
            }
        }

        // Sort the $statistik array by the 'label' key in ascending order
        usort($statistik, function ($a, $b) {
            // Extract the numeric part from the labels to sort numerically (CPMK 1, CPMK 2, etc.)
            return intval(substr($a['label'], 5)) <=> intval(substr($b['label'], 5));
        });

        // Separate the sorted labels and scores into separate arrays
        $sortedLabels = array_column($statistik, 'label');
        $sortedScores = array_column($statistik, 'score');

        // dd($statistik);


        return view('pages.rekap.rekapTahunan', [
            'statistik' => [
                'label' => $sortedLabels,
                'score' => $sortedScores
            ]
        ], compact('rekapTahunan', 'tabel', 'tahunAkademik', 'mahasiswa', 'kdkurikulum', 'statistik', 'cpl'));
    }
}
