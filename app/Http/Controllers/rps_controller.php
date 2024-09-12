<?php

namespace App\Http\Controllers;

use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_referensi_luaran;
use App\Models\ak_matakuliah_referensi_tambahan;
use App\Models\ak_matakuliah_referensi_utama;
use App\Models\ak_timeline;
use App\Models\gabung_matakuliah_pengalaman_asinkron;
use App\Models\gabung_matakuliah_pengalaman_sinkron;
use App\Models\RpsFileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class rps_controller extends Controller
{
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
            ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_utama.kdmatakuliah")
            ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_utama.id_referensi")
            ->where('kdtahunakademik', $semester)
            ->get();

        $referensiTambahan = ak_matakuliah_referensi_tambahan::where("mk.kdmatakuliah", "=", $id)
            ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_tambahan.kdmatakuliah")
            ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_tambahan.id_referensi")
            ->where('kdtahunakademik', $semester)
            ->get();

        $referensiLuaran = ak_matakuliah_referensi_luaran::where("mk.kdmatakuliah", "=", $id)
            ->join("simptt.ak_matakuliah as mk", "mk.kdmatakuliah", "=", "ak_matakuliah_referensi_luaran.kdmatakuliah")
            ->join("ak_referensi as ref", "ref.kdreferensi", "=", "ak_matakuliah_referensi_luaran.id_referensi")
            ->where('kdtahunakademik', $semester)
            ->get();

        // Timeline section
        $timeline = ak_timeline::join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', '=', 'ak_timeline.kdcpmk')
            ->join('ak_tahunakademik as ata', 'ata.kdtahunakademik', '=', 'ak_timeline.kdtahunakademik')
            ->join('ak_kurikulum_sub_bk_materi as materi', 'materi.kdmateri', '=', 'ak_timeline.kdmateri')
            ->join('ak_matakuliah_ak_kurikulum_sub_bk as mksbk', 'mksbk.id', 'materi.id_gabung')
            ->join('ak_kurikulum_sub_bks as subbk', 'subbk.id', 'mksbk.ak_kurikulum_sub_bk_id')
            ->join('ak_metodepembelajaran as amp', 'amp.id', '=', 'ak_timeline.kdmetopem')
            ->join('pt_person as pp', 'pp.kdperson', '=', 'ak_timeline.kdperson')
            ->join('ak_dosen as dos', 'dos.kdperson', '=', 'pp.kdperson')
            ->join('ak_jeniskuliah as ajk', 'ajk.kdjeniskuliah', '=', 'ak_timeline.kdjeniskuliah')
            ->where('mksbk.kdmatakuliah', $id)
            ->where('ak_timeline.kdtahunakademik', $semester)
            ->orderBy('mingguke', 'asc')
            ->get();
        // ->toSql();

        // dd($timeline);

        $relation = DB::table('ak_matakuliah_ak_kurikulum_sub_bk as mksbk')
            ->join('simptt.ak_matakuliah as mk', 'mk.kdmatakuliah', 'mksbk.kdmatakuliah')
            ->join('gabung_subbk_cpmks as gsc', 'gsc.id_gabung_subbk', 'mksbk.id')
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', 'gsc.id_cpmk')
            ->join('ak_kurikulum_sub_bks as sbk', 'sbk.id', 'mksbk.ak_kurikulum_sub_bk_id')
            ->leftJoin('gabung_cpmk_pembelajarans as gcp', 'gcp.id_gabung_cpmk', 'gsc.id')
            ->leftJoin('ak_metodepembelajaran as mp', 'mp.id', 'gcp.id_pembelajaran')
            ->where('mk.kdmatakuliah', $id)
            ->get();

        // dd($relation);

        // dd('test');

        $metodebobot = DB::table('ak_matakuliah_cpmk as amc')
            ->join('simptt.ak_matakuliah as mk', 'mk.kdmatakuliah', 'amc.kdmatakuliah')
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', 'amc.id_cpmk')
            ->join('gabung_metopen_cpmks as gmc', 'gmc.id_gabung_cpmk', 'amc.id')
            ->join('metode_penilaians as mp', 'mp.id', 'gmc.id_metopen')
            ->where('mk.kdmatakuliah', $id)
            ->get();

        // return dd($metodebobot);

        return view('pages.matakuliah.rps', compact('matakuliah', 'cpl', 'cpmk', 'asinkron', 'sinkron', 'aksesmedia', 'referensiUtama', 'referensiTambahan', 'referensiLuaran', 'timeline', 'relation', 'metodebobot'));
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
