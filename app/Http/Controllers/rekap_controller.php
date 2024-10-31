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

    // method rekap index
    public function rekap(Request $request)
    {
        $rekap = DB::table('ak_tahunakademik as ata')
            ->where("isAktif", 1)
            ->get();


        if (auth()->user()->kdunit == 100 || auth()->user()->kdunit == 0) {

            $kdkurikulum = DB::table("simptt.ak_kurikulum")
                ->where("isObe", "=", 1)
                ->get();

            $rekapTahunanIndex = DB::table("simptt.ak_mahasiswa as am")
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

            $rekapTahunanIndex = DB::table("simptt.ak_mahasiswa as am")
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

                $rekapTahunanIndex = DB::table("simptt.ak_mahasiswa as am")
                    ->select(DB::raw('distinct left(kdtamasuk,4) as tahun'))
                    ->join("simptt.ak_kurikulum as ak", "ak.kdkurikulum", "am.kdkurikulum")
                    ->where("ak.kurikulum", $request->filter)
                    ->where("isObe", 1)
                    ->get();
            }
        }

        return view('pages.rekap.index', compact('rekap', 'rekapTahunanIndex', 'kdkurikulum'));
    }

    // method rekap semester index
    public function indexSemester(int $id)
    {
        $tahunAkademik = DB::table('ak_tahunakademik as ata')
            ->where("isAktif", 1)
            ->where('kdtahunakademik', $id)
            ->first();

        $semester = ak_matakuliah::select('semester')->distinct()->get();

        return view("pages.rekap.index-semester", compact('semester', 'tahunAkademik'));
    }

    // method rekap semester
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

    // method rekap tahunan
    public function rekapTahunan(Request $request, int $id)
    {

        $filter_tahun = $request->input("filter_tahun") ?: null;
        $filter_kurikulum = $request->input("filter_kurikulum") ?: null;
        $mahasiswa = []; // Initialize mahasiswa as an empty array

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


            // $tabel = DB::select('call sistem_obe.rekap_tahun_header(?,?)', [$id, Auth::user()->kdunit]);

            // Check if filters are provided; set default values if not


            if (!empty($filter_tahun) && !empty($filter_kurikulum)) {
                $tabel = DB::select('call sistem_obe.test_tist(?,?,?)', [$id, $filter_tahun, $filter_kurikulum]);
            } else {
                $tabel = [];
            }

            // dd($tabel);

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

        // if ($request->has("filter")) {
        //     if (in_array($request->filter, $arrayKurikulum)) {
        //         $rekapTahunan = DB::select('call sistem_obe.rekap_tahunan(?,?)', [$id, $request->filter]);
        //     }
        // }

        // $rekapTahunan = DB::select('call sistem_obe.rekap_tahunan(?,?)', [$id, $request->filter]);
        // $rekap = json_decode(json_encode($rekapTahunan), true);
        // foreach ($rekap as $key => $value) {
        //     $loop = 1;
        //     foreach ($value as $urutanData => $data) {
        //         if ($loop <= 6) {
        //             $mahasiswa[$key][] = $data;
        //         } else {
        //             $mahasiswa[$key][6][$urutanData] = $data;
        //         }
        //         $loop++;
        //     }
        // }

        // $rekapCpl = DB::select('call sistem_obe.rekap_tahunan_cpl(?,?)', [$id, $request->filter]);
        // $cpl = json_decode(json_encode($rekapCpl), true);

        if ($request->has("filter_kurikulum") || $request->has("filter_tahun")) {
            if (in_array($request->filter, $arrayKurikulum)) {
                $rekapTahunan = DB::select('call sistem_obe.test_tust(?,?,?)', [$id, $filter_tahun, $filter_kurikulum]);
            }
        }

        if (!empty($filter_tahun) && !empty($filter_kurikulum)) {
            $rekapTahunan = DB::select('call sistem_obe.test_tust(?,?,?)', [$id, $filter_tahun, $filter_kurikulum]);
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
        } else {
            $rekapTahunan = [];
        }

        if (!empty($filter_tahun) && !empty($filter_kurikulum)) {

            $rekapCpl = DB::select('call sistem_obe.test_tast(?,?,?)', [$id, $filter_tahun, $filter_kurikulum]);
            $cpl = json_decode(json_encode($rekapCpl), true);
        } else {
            $cpl = [];
        }

        $statistik = [];
        foreach ($cpl as $item) {
            $statistik[] = [
                'label' => $item['cpl'],
                'score' => number_format((float)$item['total_skor_cpl'], 2)
            ];
        }

        // dd($statistik);

        // Sort the $statistik array by the 'label' key in ascending order
        usort($statistik, function ($a, $b) {
            // Extract the numeric part from the labels to sort numerically (CPMK 1, CPMK 2, etc.)
            return intval(substr($a['label'], 5)) <=> intval(substr($b['label'], 5));
        });

        // Separate the sorted labels and scores into separate arrays
        $sortedLabels = array_column($statistik, 'label');
        $sortedScores = array_column($statistik, 'score');

        return view('pages.rekap.rekapTahunan', [
            'statistik' => [
                'label' => $sortedLabels,
                'score' => $sortedScores
            ]
        ], compact('rekapTahunan', 'tabel', 'tahunAkademik', 'mahasiswa', 'kdkurikulum', 'statistik', 'cpl'));
    }

    // method rekap mahasiswa (get)
    public function rekapMahasiswaGet(Request $request)
    {
        $rekapMahasiswa = DB::select('call sistem_obe.rekap_cpl_mahasiswa(?,?)', [$request->nim, null]);
        $rekap = json_decode(json_encode($rekapMahasiswa), true);

        $cpmk = DB::select('call sistem_obe.mahasiswa_cpmk(?)', [$request->nim]);
        $mahasiswaCpmk = json_decode(json_encode($cpmk), true);

        $total_skor_cpl = DB::select('call sistem_obe.mahasiswa_total_skor_cpl(?)', [$request->nim]);
        $skor_cpl = json_decode(json_encode($total_skor_cpl), true);

        $fix = [];

        foreach ($mahasiswaCpmk as $items) {
            if (!isset($fix[$items['cpl']]['cpl_desk'])) {
                $fix[$items['cpl']]['cpl_desk'] = $items['cpl_desk'];
            }

            if (!isset($fix[$items['cpl']]['cpmk'][$items['kode_cpmk']]['cpmk_desk'])) {
                $fix[$items['cpl']]['cpmk'][$items['kode_cpmk']]['cpmk_desk'] = $items['cpmk_desk'];
            }

            if (!isset($fix[$items['cpl']]['cpmk'][$items['kode_cpmk']])) {

                // append cpl cpmk
                $fix[$items['cpl']]['cpmk'][$items['kode_cpmk']]['data'][] = [
                    'kodematakuliah' => $items['kodematakuliah'],
                    'matakuliah' => $items['matakuliah'],
                    'nilai' => $items['nilai'],
                    'total_bobot' => $items['total_bobot'],
                    'skor_nilaixbobot' => $items['skor_nilaixbobot']
                ];
            } else {
                $fix[$items['cpl']]['cpmk'][$items['kode_cpmk']]['data'][] = [
                    'kodematakuliah' => $items['kodematakuliah'],
                    'matakuliah' => $items['matakuliah'],
                    'nilai' => $items['nilai'],
                    'total_bobot' => $items['total_bobot'],
                    'skor_nilaixbobot' => $items['skor_nilaixbobot']
                ];
            }
        }

        // mapping score cpl
        foreach ($skor_cpl as $key => $item) {
            if (isset($fix[$item['cpl']])) {
                $fix[$item['cpl']]['total_score_cpl'] = $item['total_skor_cpl'];
            }
        }

        $hitung = [];

        foreach ($fix as $cpl => $cpmk) {
            foreach ($cpmk['cpmk'] as $cpmkKey => $datas) {
                foreach ($datas['data'] as $data) {
                    if (!isset($hitung[$cpmkKey]['nilaixbobot'])) {
                        $hitung[$cpmkKey]['nilaixbobot'] = $data['skor_nilaixbobot'];
                    } else {
                        // tambah dari value sebelumnya
                        $hitung[$cpmkKey]['nilaixbobot'] += $data['skor_nilaixbobot'];
                    }

                    if (!isset($hitung[$cpmkKey]['sumBobot'])) {
                        $hitung[$cpmkKey]['sumBobot'] = (int)$data['total_bobot'];
                    } else {
                        // tambah dari value sebelumnya
                        $hitung[$cpmkKey]['sumBobot'] += (int)$data['total_bobot'];
                    }
                }
            }
        }

        $final = [];
        foreach ($hitung as $key => $item) {
            $final[$key] = round($item['nilaixbobot'] / $item['sumBobot'], 2);
        }

        foreach ($fix as $cpl => $items) {
            foreach ($items['cpmk'] as $cpmk => $item) {
                if (isset($final[$cpmk])) {
                    $fix[$cpl]['cpmk'][$cpmk]['total_cpmk'] = $final[$cpmk];
                }
            }
        }


        $statistik = [];
        foreach ($skor_cpl as $item) {
            $statistik[] = [
                'label' => $item['cpl'],
                'score' => number_format((float)$item['total_skor_cpl'], 2)
            ];
        }

        // Sort the $statistik array by the 'label' key in ascending order
        usort($statistik, function ($a, $b) {
            // Extract the numeric part from the labels to sort numerically (CPMK 1, CPMK 2, etc.)
            return intval(substr($a['label'], 5)) <=> intval(substr($b['label'], 5));
        });

        // Separate the sorted labels and scores into separate arrays
        $sortedLabels = array_column($statistik, 'label');
        $sortedScores = array_column($statistik, 'score');

        // dd($mahasiswaCpmk, $fix);

        session([
            'rekap' => $rekap,
            'statistik' => [
                'label' => $sortedLabels,
                'score' => $sortedScores,
            ],
            'fix' => $fix,
            'mahasiswaCpmk' => $mahasiswaCpmk,
            'skor_cpl' => $skor_cpl,
        ]);


        return view("pages.rekap.rekapMahasiswa", [
            'statistik' => [
                'label' => $sortedLabels,
                'score' => $sortedScores
            ]
        ], compact('rekap', 'statistik', 'fix', 'mahasiswaCpmk', 'skor_cpl'));
    }

    public function transkripCPL(Request $request)
    {
        $rekapMahasiswa = DB::select('call sistem_obe.rekap_cpl_mahasiswa(?,?)', [$request->nim, null]);
        $rekap = json_decode(json_encode($rekapMahasiswa), true);

        $cpmk = DB::select('call sistem_obe.mahasiswa_cpmk(?)', [$request->nim]);
        $mahasiswaCpmk = json_decode(json_encode($cpmk), true);

        $total_skor_cpl = DB::select('call sistem_obe.mahasiswa_total_skor_cpl(?)', [$request->nim]);
        $skor_cpl = json_decode(json_encode($total_skor_cpl), true);

        $fix = [];

        foreach ($mahasiswaCpmk as $items) {
            if (!isset($fix[$items['cpl']]['cpl_desk'])) {
                $fix[$items['cpl']]['cpl_desk'] = $items['cpl_desk'];
            }

            if (!isset($fix[$items['cpl']]['cpmk'][$items['kode_cpmk']]['cpmk_desk'])) {
                $fix[$items['cpl']]['cpmk'][$items['kode_cpmk']]['cpmk_desk'] = $items['cpmk_desk'];
            }

            if (!isset($fix[$items['cpl']]['cpmk'][$items['kode_cpmk']])) {

                // append cpl cpmk
                $fix[$items['cpl']]['cpmk'][$items['kode_cpmk']]['data'][] = [
                    'kodematakuliah' => $items['kodematakuliah'],
                    'matakuliah' => $items['matakuliah'],
                    'nilai' => $items['nilai'],
                    'total_bobot' => $items['total_bobot'],
                    'skor_nilaixbobot' => $items['skor_nilaixbobot']
                ];
            } else {
                $fix[$items['cpl']]['cpmk'][$items['kode_cpmk']]['data'][] = [
                    'kodematakuliah' => $items['kodematakuliah'],
                    'matakuliah' => $items['matakuliah'],
                    'nilai' => $items['nilai'],
                    'total_bobot' => $items['total_bobot'],
                    'skor_nilaixbobot' => $items['skor_nilaixbobot']
                ];
            }
        }

        // mapping score cpl
        foreach ($skor_cpl as $key => $item) {
            if (isset($fix[$item['cpl']])) {
                $fix[$item['cpl']]['total_score_cpl'] = $item['total_skor_cpl'];
            }
        }

        $hitung = [];

        foreach ($fix as $cpl => $cpmk) {
            foreach ($cpmk['cpmk'] as $cpmkKey => $datas) {
                foreach ($datas['data'] as $data) {
                    if (!isset($hitung[$cpmkKey]['nilaixbobot'])) {
                        $hitung[$cpmkKey]['nilaixbobot'] = $data['skor_nilaixbobot'];
                    } else {
                        // tambah dari value sebelumnya
                        $hitung[$cpmkKey]['nilaixbobot'] += $data['skor_nilaixbobot'];
                    }

                    if (!isset($hitung[$cpmkKey]['sumBobot'])) {
                        $hitung[$cpmkKey]['sumBobot'] = (int)$data['total_bobot'];
                    } else {
                        // tambah dari value sebelumnya
                        $hitung[$cpmkKey]['sumBobot'] += (int)$data['total_bobot'];
                    }
                }
            }
        }

        $final = [];
        foreach ($hitung as $key => $item) {
            $final[$key] = round($item['nilaixbobot'] / $item['sumBobot'], 2);
        }

        foreach ($fix as $cpl => $items) {
            foreach ($items['cpmk'] as $cpmk => $item) {
                if (isset($final[$cpmk])) {
                    $fix[$cpl]['cpmk'][$cpmk]['total_cpmk'] = $final[$cpmk];
                }
            }
        }


        $statistik = [];
        foreach ($skor_cpl as $item) {
            $statistik[] = [
                'label' => $item['cpl'],
                'score' => number_format((float)$item['total_skor_cpl'], 2)
            ];
        }

        // Sort the $statistik array by the 'label' key in ascending order
        usort($statistik, function ($a, $b) {
            // Extract the numeric part from the labels to sort numerically (CPMK 1, CPMK 2, etc.)
            return intval(substr($a['label'], 5)) <=> intval(substr($b['label'], 5));
        });

        // Separate the sorted labels and scores into separate arrays
        $sortedLabels = array_column($statistik, 'label');
        $sortedScores = array_column($statistik, 'score');

        // dd($fix);

        $rekap = session('rekap');
        $statistik = session('statistik');
        $fix = session('fix');
        $mahasiswaCpmk = session('mahasiswaCpmk');
        $skor_cpl = session('skor_cpl');

        if (!$rekap || !$statistik || !$fix || !$mahasiswaCpmk || !$skor_cpl) {
            // Handle the case where data is missing, e.g., redirect or show an error
            dd("Data Kosong");
        }

        return view("pages.rekap.transkripcpl", [
            'statistik' => $statistik,
            // Pass the other variables as needed
            'rekap' => $rekap,
            'fix' => $fix,
            'mahasiswaCpmk' => $mahasiswaCpmk,
            'skor_cpl' => $skor_cpl,
        ], compact('rekap', 'statistik', 'fix', 'mahasiswaCpmk', 'skor_cpl'));
    }
}
