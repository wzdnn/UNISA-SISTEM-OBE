<?php

namespace App\Http\Controllers;

use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_referensi_luaran;
use App\Models\ak_matakuliah_referensi_tambahan;
use App\Models\ak_matakuliah_referensi_utama;
use App\Models\ak_timeline;
use App\Models\gabung_matakuliah_pengalaman_asinkron;
use App\Models\gabung_matakuliah_pengalaman_sinkron;
use App\Models\gabung_matakuliah_subbk;
use App\Models\RpsFileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class rps_controller extends Controller
{
    public function getTotalAccumulatedTimeByMatakuliah($kdmatakuliah)
    {
        // Cari gabungan matakuliah berdasarkan kdmatakuliah
        $gabungMatakuliah = gabung_matakuliah_subbk::where('kdmatakuliah', $kdmatakuliah)->get();

        // Inisialisasi array untuk akumulasi waktu berdasarkan field
        $totalTimes = [
            'kuliah' => 0,
            'tutorial' => 0,
            'seminar' => 0,
            'praktikum' => 0,
            'skill_lab' => 0,
            'field_lab' => 0,
            'praktik' => 0,
            'penugasan' => 0,
            'belajar_mandiri' => 0,
        ];

        foreach ($gabungMatakuliah as $gabung) {
            // Cari semua subbk terkait id_gabung dari gabung_matakuliah_subbk
            $subbkRecords = $gabung->subbkMateri;

            // Hitung total waktu per field
            foreach ($subbkRecords as $subbk) {
                $totalTimes['kuliah'] += $subbk->kuliah ?? 0;
                $totalTimes['tutorial'] += $subbk->tutorial ?? 0;
                $totalTimes['seminar'] += $subbk->seminar ?? 0;
                $totalTimes['praktikum'] += $subbk->praktikum ?? 0;
                $totalTimes['skill_lab'] += $subbk->skill_lab ?? 0;
                $totalTimes['field_lab'] += $subbk->field_lab ?? 0;
                $totalTimes['praktik'] += $subbk->praktik ?? 0;
                $totalTimes['penugasan'] += $subbk->penugasan ?? 0;
                $totalTimes['belajar_mandiri'] += $subbk->belajar_mandiri ?? 0;
            }
        }

        // dd($totalTimes); // Menampilkan akumulasi waktu per field

        return $totalTimes;
    }

    public function rps(int $id, int $semester)
    {
        $matakuliah = ak_matakuliah::findOrFail($id);

        $cpl = DB::table('ak_matakuliah_ak_kurikulum_sub_bk as amsb')
            ->select('kode_cpl', 'deskripsi_cpl')
            ->join('gabung_subbk_cpmks as gsc', 'gsc.id_gabung_subbk', "=", "amsb.id")
            ->join('ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk', 'cplcpmk.ak_kurikulum_cpmk_id', '=', 'gsc.id_cpmk')
            ->join('ak_kurikulum_cpls as cpl', 'cpl.id', '=', 'cplcpmk.ak_kurikulum_cpl_id')
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', '=', 'cplcpmk.ak_kurikulum_cpmk_id')
            ->where('kdmatakuliah', $id)
            ->distinct()
            ->get();

        $cpmk = DB::table('ak_matakuliah_ak_kurikulum_sub_bk as amsb')
            ->select('kode_cpmk', 'cpmk')
            ->join('gabung_subbk_cpmks as gsc', 'gsc.id_gabung_subbk', "=", "amsb.id")
            ->join('ak_kurikulum_cpl_ak_kurikulum_cpmk as cplcpmk', 'cplcpmk.ak_kurikulum_cpmk_id', '=', 'gsc.id_cpmk')
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', '=', 'cplcpmk.ak_kurikulum_cpmk_id')
            ->where('kdmatakuliah', $id)
            ->distinct()
            ->get();

        // dd($cplcpmk);

        $asinkron = gabung_matakuliah_pengalaman_asinkron::select('pengalaman_mahasiswa')
            ->join('ak_pengalamanmahasiswa as apm', 'apm.id', '=', "gabung_matakuliah_pengalaman_asinkron.id_pengalaman")
            ->where('kdmatakuliah', $id)
            ->where('kdtahunakademik', $semester)
            ->get();

        $sinkron = gabung_matakuliah_pengalaman_sinkron::select('pengalaman_mahasiswa')
            ->join('ak_pengalamanmahasiswa as apm', 'apm.id', '=', "gabung_matakuliah_pengalaman_sinkron.id_pengalaman")
            ->where('kdmatakuliah', $id)
            ->where('kdtahunakademik', $semester)
            ->get();

        $aksesmedia = DB::table('gabung_matakuliah_akses as gma')
            ->join('ak_aksesmedia as am', 'am.kdakses', '=', 'gma.kdakses')
            ->where('kdmatakuliah', $id)
            ->where('kdtahunakademik', $semester)
            // ->get();
            ->first();
        // $aksesmedia = gabung_matakuliah_akses::first();

        // dd($aksesmedia);

        $referensiUtama = ak_matakuliah_referensi_utama::where("mk.kdmatakuliah", "=", $id)
            ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_utama.kdmatakuliah")
            ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_utama.id_referensi")
            ->where('kdtahunakademik', $semester)
            ->get();

        $referensiTambahan = ak_matakuliah_referensi_tambahan::where("mk.kdmatakuliah", "=", $id)
            ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_tambahan.kdmatakuliah")
            ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_tambahan.id_referensi")
            ->where('kdtahunakademik', $semester)
            ->get();

        $referensiLuaran = ak_matakuliah_referensi_luaran::where("mk.kdmatakuliah", "=", $id)
            ->join("ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_luaran.kdmatakuliah")
            ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_luaran.id_referensi")
            ->where('kdtahunakademik', $semester)
            // ->toSql();
            ->get();

        // Timeline section
        $timeline = ak_timeline::join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', '=', 'ak_timeline.kdcpmk')
            ->join('ak_tahunakademik as ata', 'ata.kdtahunakademik', '=', 'ak_timeline.kdtahunakademik')
            ->join('ak_kurikulum_sub_bk_materi as materi', 'materi.kdmateri', '=', 'ak_timeline.kdmateri')
            ->join('ak_matakuliah_ak_kurikulum_sub_bk as mksbk', 'mksbk.id', 'materi.id_gabung')
            ->join('ak_kurikulum_sub_bks as subbk', 'subbk.id', 'mksbk.ak_kurikulum_sub_bk_id')
            ->join('ak_metodepembelajaran as amp', 'amp.id', '=', 'ak_timeline.kdmetopem')
            ->join('ak_jeniskuliah as ajk', 'ajk.kdjeniskuliah', '=', 'ak_timeline.kdjeniskuliah')
            ->where('mksbk.kdmatakuliah', $id)
            ->where('ak_timeline.kdtahunakademik', $semester)
            ->orderBy('mingguke', 'asc')
            ->get();
        // ->toSql();

        $timelineWithDosenKelas = ak_timeline::join('gabung_timeline_dosen as gtd', 'gtd.kdtimeline', '=', 'ak_timeline.kdtimeline')
            ->join('simptt.ak_dosen as dosen', 'dosen.kdperson', '=', 'gtd.kdperson')
            ->join('simptt.pt_person as pp', 'pp.kdperson', '=', 'dosen.kdperson')
            ->join('ak_kelas as kelas', 'kelas.kdkelas', '=', 'gtd.kdkelas')
            ->where('ak_timeline.kdmatakuliah', $id)
            ->get();

        // dd($timeline);

        $relation = DB::table('ak_matakuliah_ak_kurikulum_sub_bk as mksbk')
            ->join('ak_matakuliah as mk', 'mk.kdmatakuliah', 'mksbk.kdmatakuliah')
            ->join('gabung_subbk_cpmks as gsc', 'gsc.id_gabung_subbk', 'mksbk.id')
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', 'gsc.id_cpmk')
            ->join('ak_kurikulum_sub_bks as sbk', 'sbk.id', 'mksbk.ak_kurikulum_sub_bk_id')
            ->leftJoin('gabung_cpmk_pembelajarans as gcp', 'gcp.id_gabung_cpmk', 'gsc.id')
            ->leftJoin('ak_metodepembelajaran as mp', 'mp.id', 'gcp.id_pembelajaran')
            ->where('mk.kdmatakuliah', $id)
            ->get();

        // dd($referensiLuaran);

        // dd('test');

        $metodebobot = DB::table('ak_matakuliah_cpmk as amc')
            ->join('ak_matakuliah as mk', 'mk.kdmatakuliah', 'amc.kdmatakuliah')
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', 'amc.id_cpmk')
            ->join('gabung_metopen_cpmks as gmc', 'gmc.id_gabung_cpmk', 'amc.id')
            ->join('metode_penilaians as mp', 'mp.id', 'gmc.id_metopen')
            ->where('mk.kdmatakuliah', $id)
            ->get();

        // return dd($metodebobot);

        $waktu = $this->getTotalAccumulatedTimeByMatakuliah($id);

        // dd($waktu);

        return view('pages.matakuliah.rps', compact('waktu', 'matakuliah', 'cpl', 'cpmk', 'asinkron', 'sinkron', 'aksesmedia', 'referensiUtama', 'referensiTambahan', 'referensiLuaran', 'timeline', 'relation', 'metodebobot', 'timelineWithDosenKelas'));
    }

    public function index(Request $request, int $id)
    {
        $matakuliah = ak_matakuliah::findOrFail($id);

        $tahunAkademik = DB::table('ak_tahunakademik as ata')
            ->where("isAktif", 1)
            ->get();

        return view('pages.rps.index', compact('tahunAkademik', 'matakuliah'));
    }

    public function detail(Request $request, int $id, int $semester)
    {
        $matakuliah = ak_matakuliah::findOrFail($id);

        $tahunAkademik = DB::table('ak_tahunakademik as ata')
            ->where("isAktif", 1)
            ->where('kdtahunakademik', $semester)
            ->first();

        $rubik = RpsFileUpload::where(["kdmatakuliah" => $id, 'kdtahunakademik' => $semester])->get();

        // dd($tahunAkademik);

        return view('pages.rps.detail', compact('matakuliah', 'tahunAkademik', 'rubik'));
    }

    public function fileUploadPost(Request $request, int $id, $tahun)
    {
        $request->validate([
            'file' => ["required", "max:2000"]
        ]);

        try {
            $folder = rand();

            $file = \Illuminate\Support\Str::random() . '-' . $request->file('file')->getClientOriginalName();

            // save to db
            RpsFileUpload::create([
                'folder' => $folder,
                'file' => $file,
                'kdmatakuliah' => $id,
                'kdtahunakademik' => $tahun
            ]);

            Storage::putFileAs("public/rps-rubrik/$folder", $request->file('file'), $file);

            return redirect(url()->previous())->with('success', 'rubik berhasil di up');
        } catch (Throwable $th) {
            dd($th->getMessage());
        }
        return dd($request->all(), $id, $tahun);
    }

    public function delete(int $id, int $semester, $kdfile)
    {
        $file = RpsFileUpload::findOrFail($kdfile);

        Storage::deleteDirectory("public/rubik/" . $file->folder);

        $file->delete();

        return redirect(url()->previous())->with('success', 'berhasil hapus');
    }
}
