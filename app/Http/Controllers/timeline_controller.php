<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_sub_bk;
use App\Models\ak_kurikulum_sub_bk_materi;
use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_cpmk;
use App\Models\ak_tahunakademik;
use App\Models\ak_timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class timeline_controller extends Controller
{
    //Timeline matakuliah

    public function timeline(int $id)
    {

        $matakuliah = ak_matakuliah::findOrFail($id);

        $timeline = ak_timeline::select('ak_timeline.keterangan', 'mingguke', 'kode_cpmk', 'kode_subbk', 'materi_pembelajaran', 'namalengkap', 'gelarbelakang', 'jeniskuliah', 'kdtimeline', 'metodepembelajaran')
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', '=', 'ak_timeline.kdcpmk')
            ->join('ak_tahunakademik as ata', 'ata.kdtahunakademik', '=', 'ak_timeline.kdtahunakademik')
            ->join('ak_kurikulum_sub_bk_materi as materi', 'materi.kdmateri', 'ak_timeline.kdmateri')
            ->join('ak_matakuliah_ak_kurikulum_sub_bk as mksbk', 'mksbk.id', 'materi.id_gabung')
            ->join('ak_kurikulum_sub_bks as subbk', 'subbk.id', 'mksbk.ak_kurikulum_sub_bk_id')
            ->join('ak_metodepembelajaran as amp', 'amp.id', '=', 'ak_timeline.kdmetopem')
            ->join('pt_person as pp', 'pp.kdperson', '=', 'ak_timeline.kdperson')
            ->join('ak_dosen as dos', 'dos.kdperson', '=', 'pp.kdperson')
            ->join('ak_jeniskuliah as ajk', 'ajk.kdjeniskuliah', '=', 'ak_timeline.kdjeniskuliah')
            ->where('ak_timeline.kdmatakuliah', $id)
            // ->toSql();
            ->get();

        // dd($timeline);

        return view('pages.detailMatakuliah.timeline', compact('matakuliah', 'timeline'));
    }


    public function createTimeline(int $id)
    {

        $matakuliah = ak_matakuliah::findOrFail($id);

        $filter = ak_tahunakademik::where("isaktif", 1)->orderBy("kdtahunakademik", "desc")->first();

        $cpmk = ak_matakuliah_cpmk::join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "ak_matakuliah_cpmk.id_cpmk")
            ->where('kdmatakuliah', $id)
            ->get();

        // $materi = ak_kurikulum_sub_bk::join("ak_kurikulum", "ak_kurikulum.kdkurikulum", "=", "ak_kurikulum_sub_bks.kdkurikulum")
        //     ->where("ak_kurikulum.kdunitkerja", Auth::user()->kdunit)
        //     ->get();

        $materi = ak_kurikulum_sub_bk_materi::join('ak_matakuliah_ak_kurikulum_sub_bk as mksbk', 'mksbk.id', 'ak_kurikulum_sub_bk_materi.id_gabung')
            ->join('ak_kurikulum_sub_bks as sbk', 'sbk.id', 'mksbk.ak_kurikulum_sub_bk_id')
            ->where('mksbk.kdmatakuliah', $id)
            ->get();

        $jeniskuliah = DB::table('ak_jeniskuliah')
            ->get();

        $metopem = DB::table('ak_metodepembelajaran')->get();

        $dosen = DB::table('simptt.ak_dosen as ad')
            ->join('simptt.pt_person as pp', "pp.kdperson", "=", "ad.kdperson")
            // ->where('kdunitkerja', Auth::user()->kdunit)
            ->get();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();

        // dd($materi);

        return view('pages.detailMatakuliah.createTimeline', compact('matakuliah', 'cpmk', 'materi', 'jeniskuliah', 'metopem', 'dosen', 'tahunAkademik'));
    }

    public function storeTimeline(Request $request)
    {
        $request->validate([
            "mingguke"
        ]);

        $timeline = ak_timeline::create([
            'mingguke' => $request->mingguke,
            'kdcpmk' => $request->kdcpmk,
            'kdmetopem' => $request->kdmetopem,
            'kdtahunakademik' => $request->tahunakademik,
            'kdmatakuliah' => $request->kdmatakuliah,
            'kdperson' => $request->kdperson,
            'kdjeniskuliah' => $request->kdjeniskuliah,
            'kdmateri' => $request->kdmateri,
            'keterangan' => $request->keterangan
        ]);


        // dd($timeline);

        return redirect()->back()->with('success', 'Timeline berhasil ditambahkan');
    }

    public function deleteTimeline(int $id)
    {
        $timeline = ak_timeline::where('kdtimeline', $id);

        if (!$timeline) {
            return abort(404);
        }

        $timeline->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    public function editTimeline(int $id, int $kdtimeline)
    {
        $matakuliah = ak_matakuliah::findOrFail($id);

        $filter = ak_tahunakademik::where("isaktif", 1)->orderBy("kdtahunakademik", "desc")->first();

        $cpmk = ak_matakuliah_cpmk::join("ak_kurikulum_cpmks as cpmk", "cpmk.id", "=", "ak_matakuliah_cpmk.id_cpmk")
            ->where('kdmatakuliah', $id)
            ->get();

        $materi = ak_kurikulum_sub_bk_materi::join('ak_matakuliah_ak_kurikulum_sub_bk as mksbk', 'mksbk.id', 'ak_kurikulum_sub_bk_materi.id_gabung')
            ->join('ak_kurikulum_sub_bks as sbk', 'sbk.id', 'mksbk.ak_kurikulum_sub_bk_id')
            ->where('mksbk.kdmatakuliah', $id)
            ->get();
        // ->toSql();

        // dd($materi);

        $jeniskuliah = DB::table('ak_jeniskuliah')
            ->get();

        $metopem = DB::table('ak_metodepembelajaran')->get();

        $dosen = DB::table('simptt.ak_dosen as ad')
            ->join('simptt.pt_person as pp', "pp.kdperson", "=", "ad.kdperson")
            // ->where('kdunitkerja', Auth::user()->kdunit)
            ->get();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();

        $timeline = ak_timeline::where('kdtimeline', $kdtimeline)->first();

        $id_cpmk = [];
        $id_jeniskuliah = [];
        $id_materi = [];
        $id_metopem = [];
        $id_tahunakademik = [];
        $id_dosen = [];

        $id_mk = [];


        if ($timeline) {
            $id_cpmk[] = $timeline->kdcpmk;
            $id_jeniskuliah[] = $timeline->kdjeniskuliah;
            $id_materi[] = $timeline->kdmateri;
            $id_metopem[] = $timeline->kdmetopem;
            $id_tahunakademik[] = $timeline->kdtahunakademik;
            $id_dosen[] = $timeline->kdperson;
        }

        if ($matakuliah) {
            $id_mk[] = $matakuliah->kdmatakuliah;
        }

        // dd($timeline);

        return view('pages.detailMatakuliah.editTimeline', compact('matakuliah', 'cpmk', 'materi', 'jeniskuliah', 'metopem', 'dosen', 'tahunAkademik', 'timeline', 'id_cpmk', 'id_jeniskuliah', 'id_materi', 'id_metopem', 'id_tahunakademik', 'id_dosen', 'id_mk'));
    }

    public function updateTimeline(Request $request, int $id)
    {

        $timeline = ak_timeline::where('kdtimeline', $id)->first();

        $timeline->update([
            'mingguke' => $request->mingguke,
            'kdcpmk' => $request->kdcpmk,
            'kdmetopem' => $request->kdmetopem,
            'kdtahunakademik' => $request->tahunakademik,
            'kdmatakuliah' => $request->kdmatakuliah,
            'kdperson' => $request->kdperson,
            'kdjeniskuliah' => $request->kdjeniskuliah,
            'kdmateri' => $request->kdmateri,
            'keterangan' => $request->keterangan
        ]);

        // dd($timeline);

        return redirect()->route("timeline.index", ['id' => $timeline->kdmatakuliah]);
    }
}
