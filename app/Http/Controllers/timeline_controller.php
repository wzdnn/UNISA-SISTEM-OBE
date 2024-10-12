<?php

namespace App\Http\Controllers;

use App\Models\ak_kurikulum_sub_bk;
use App\Models\ak_kurikulum_sub_bk_materi;
use App\Models\ak_kurikulum_sub_cpmk;
use App\Models\ak_matakuliah;
use App\Models\ak_matakuliah_cpmk;
use App\Models\ak_tahunakademik;
use App\Models\ak_timeline;
use App\Models\gabung_timeline_dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class timeline_controller extends Controller
{
    // method timeline index
    public function timeline(int $id)
    {

        $matakuliah = ak_matakuliah::findOrFail($id);

        $timeline = ak_timeline::select(
            'ak_timeline.keterangan',
            'mingguke',
            'kode_cpmk',
            'kode_subcpmk',
            'sub_cpmk',
            'kode_subbk',
            'materi_pembelajaran',
            'jeniskuliah',
            'ak_timeline.kdtimeline',
            'metodepembelajaran'
        )
            ->join('ak_kurikulum_cpmks as cpmk', 'cpmk.id', '=', 'ak_timeline.kdcpmk')
            ->leftJoin('ak_kurikulum_sub_cpmk as subcpmk', 'subcpmk.kdsubcpmk', 'ak_timeline.kdsubcpmk')
            ->join('ak_tahunakademik as ata', 'ata.kdtahunakademik', '=', 'ak_timeline.kdtahunakademik')
            ->join('ak_kurikulum_sub_bk_materi as materi', 'materi.kdmateri', 'ak_timeline.kdmateri')
            ->join('ak_matakuliah_ak_kurikulum_sub_bk as mksbk', 'mksbk.id', 'materi.id_gabung')
            ->join('ak_kurikulum_sub_bks as subbk', 'subbk.id', 'mksbk.ak_kurikulum_sub_bk_id')
            ->join('simptt.ak_metodepembelajaran as amp', 'amp.kdmetodepembelajaran', '=', 'ak_timeline.kdmetopem')
            ->join('ak_jeniskuliah as ajk', 'ajk.kdjeniskuliah', '=', 'ak_timeline.kdjeniskuliah')
            ->where('ak_timeline.kdmatakuliah', $id)
            ->orderBy('mingguke', 'asc')
            ->get();


        $timelineWithDosenKelas = ak_timeline::join('gabung_timeline_dosen as gtd', 'gtd.kdtimeline', '=', 'ak_timeline.kdtimeline')
            ->join('simptt.ak_dosen as dosen', 'dosen.kdperson', '=', 'gtd.kdperson')
            ->join('simptt.pt_person as pp', 'pp.kdperson', '=', 'dosen.kdperson')
            ->join('ak_kelas as kelas', 'kelas.kdkelas', '=', 'gtd.kdkelas')
            ->where('ak_timeline.kdmatakuliah', $id)
            ->get();

        return view('pages.detailMatakuliah.timeline', compact('matakuliah', 'timeline', 'timelineWithDosenKelas'));
    }

    // method timeline create
    public function createTimeline(int $id)
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

        $jeniskuliah = DB::table('ak_jeniskuliah')
            ->get();

        $metopem = DB::table('simptt.ak_metodepembelajaran as mp')
            ->join("gabung_cpmk_pembelajarans as gcp", "gcp.id_pembelajaran", "mp.kdmetodepembelajaran")
            ->join("gabung_subbk_cpmks as gsc", "gsc.id", "gcp.id_gabung_cpmk")
            ->distinct()
            ->get();

        $dosen = DB::table('simptt.ak_dosen as ad')
            ->join('simptt.pt_person as pp', "pp.kdperson", "=", "ad.kdperson")
            ->select('namalengkap', 'pp.kdperson as kdper', 'gelardepan', 'gelarbelakang')
            // ->where('kdunitkerja', Auth::user()->kdunit)
            ->get();

        $kelas = DB::table('ak_kelas')
            ->select('kdkelas', 'kelas')
            ->get();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();

        // dd($cpmk);

        return view('pages.detailMatakuliah.createTimeline', compact('matakuliah', 'cpmk', 'materi', 'jeniskuliah', 'metopem', 'dosen', 'tahunAkademik', 'kelas'));
    }

    // method untuk javascript mengambil metode pembelajaran sesuai cpmk yang dipilih
    public function getMetodePembelajaranByCpmk($cpmk_id)
    {
        // \Log::info('CPMK ID: ' . $cpmk_id);

        $metopem = DB::table('simptt.ak_metodepembelajaran as mp')
            ->join("gabung_cpmk_pembelajarans as gcp", "gcp.id_pembelajaran", "mp.kdmetodepembelajaran")
            ->join("gabung_subbk_cpmks as gsc", "gsc.id", "gcp.id_gabung_cpmk")
            ->where("gsc.id_cpmk", $cpmk_id)
            ->select('mp.kdmetodepembelajaran', 'metodepembelajaran')
            ->get();

        // \Log::info('Metode Pembelajaran: ' . $metopem->toJson());

        return response()->json($metopem);
    }

    // method untuk javascript mengambil sub cpmk sesuai cpmk yang dipilih
    public function getSubCpmkByCpmk($cpmk_id)
    {
        $subCpmk = DB::table('ak_kurikulum_sub_cpmk as subcpmk')
            ->join("gabung_cpmk_subcpmk as gcs", "gcs.id_subcpmk", "subcpmk.kdsubcpmk")
            ->join('gabung_subbk_cpmks as gsc', "gsc.id", "gcs.id_gabung_cpmk")
            ->where("gsc.id_cpmk", $cpmk_id)
            ->select("subcpmk.kdsubcpmk", "subcpmk.kode_subcpmk", "subcpmk.sub_cpmk")
            ->get();

        return response()->json($subCpmk);
    }

    // method timeline store
    public function storeTimeline(Request $request, int $id)
    {
        $request->validate([
            "mingguke" => 'required',
        ]);

        $timeline = ak_timeline::create([
            'mingguke' => $request->mingguke,
            'kdcpmk' => $request->kdcpmk,
            'kdmetopem' => $request->kdmetopem,
            'kdtahunakademik' => $request->tahunakademik,
            'kdmatakuliah' => $request->kdmatakuliah,
            'kdjeniskuliah' => $request->kdjeniskuliah,
            'kdmateri' => $request->kdmateri,
            'kdsubcpmk' => $request->kdsubcpmk,
            'keterangan' => $request->keterangan
        ]);

        if ($request->has('dosen') && $request->has('kelas')) {

            $kdtimeline = $timeline->kdtimeline;

            foreach ($request->input('dosen') as $key => $kdperson) {

                $kdkelas = $request->input('kelas')[$key];

                DB::table('gabung_timeline_dosen')->insert([
                    'kdtimeline' => $kdtimeline,
                    'kdperson' => $kdperson,
                    'kdkelas' => $kdkelas,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Timeline berhasil ditambahkan');
    }

    // method timeline delete
    public function deleteTimeline(int $id)
    {
        $timeline = ak_timeline::where('kdtimeline', $id);

        if (!$timeline) {
            return abort(404);
        }

        $timeline->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    // method untuk javascript mengambil metode pembelajaran sesuai cpmk yang dipilh
    public function getMetodePembelajaran($cpmk_id)
    {
        // Fetch `metode_pembelajaran` related to the selected `CPMK`
        $metodePembelajaran = DB::table('simptt.ak_metodepembelajaran as mp')
            ->join("gabung_cpmk_pembelajarans as gcp", "gcp.id_pembelajaran", "mp.kdmetodepembelajaran")
            ->join("gabung_subbk_cpmks as gsc", "gsc.id", "gcp.id_gabung_cpmk")
            ->where("gsc.id_cpmk", $cpmk_id)
            ->select('mp.kdmetodepembelajaran', 'metodepembelajaran')
            ->get();

        return response()->json($metodePembelajaran);
        dd($metodePembelajaran);
    }

    // method timeline edit
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

        $jeniskuliah = DB::table('ak_jeniskuliah')
            ->get();

        $metopem = DB::table('simptt.ak_metodepembelajaran')->get();

        $subCpmk = ak_kurikulum_sub_cpmk::with('subcpmk_get') // Load the relation directly
            ->join("simptt.ak_kurikulum", "ak_kurikulum_sub_cpmk.kdkurikulum", "=", "simptt.ak_kurikulum.kdkurikulum")
            ->where('kdunitkerja', '=', auth()->user()->kdunit)
            ->get();

        $tahunAkademik = DB::table('ak_tahunakademik')
            ->where("isAktif", "=", 1)
            ->get();

        $dosen = DB::table('simptt.ak_dosen as ad')
            ->join('simptt.pt_person as pp', "pp.kdperson", "=", "ad.kdperson")
            ->select('namalengkap', 'pp.kdperson as kdper', 'gelardepan', 'gelarbelakang')
            ->get();

        $kelas = DB::table('ak_kelas')
            ->select('kdkelas', 'kelas')
            ->get();

        $timeline = ak_timeline::where('kdtimeline', $kdtimeline)->first();

        $timeline_gabung = gabung_timeline_dosen::where('kdtimeline', $kdtimeline)
            ->get(['kdperson', 'kdkelas']);

        $id_cpmk = [];
        $id_jeniskuliah = [];
        $id_materi = [];
        $id_metopem = [];
        $id_subcpmk = [];
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
            $id_subcpmk[] = $timeline->kdsubcpmk;
        }

        if ($matakuliah) {
            $id_mk[] = $matakuliah->kdmatakuliah;
        }

        return view('pages.detailMatakuliah.editTimeline', compact('subCpmk', 'matakuliah', 'cpmk', 'materi', 'jeniskuliah', 'metopem', 'tahunAkademik', 'timeline', 'id_cpmk', 'id_jeniskuliah', 'id_materi', 'id_metopem', 'id_tahunakademik', 'id_dosen', 'id_mk', 'dosen', 'kelas', 'timeline_gabung', 'kdtimeline'));
    }

    // method delete dosen pada edit
    public function deleteDosen($id, $kdtimeline, $kdperson)
    {
        // Delete the dosen associated with the timeline
        $result = gabung_timeline_dosen::where('kdtimeline', $kdtimeline)
            ->where('kdperson', $kdperson)
            ->delete();

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Dosen deleted successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to delete dosen'], 500);
    }

    // method timeline update
    public function updateTimeline(Request $request, int $id)
    {
        // Update the ak_timeline record
        $timeline = ak_timeline::where('kdtimeline', $id)->first();

        if (!$timeline) {
            return redirect()->back()->withErrors(['message' => 'Timeline not found.']);
        }

        $timeline->update([
            'mingguke' => $request->mingguke,
            'kdcpmk' => $request->kdcpmk,
            'kdmetopem' => $request->kdmetopem,
            'kdsubcpmk' => $request->kdsubcpmk,
            'kdtahunakademik' => $request->tahunakademik,
            'kdmatakuliah' => $request->kdmatakuliah,
            'kdjeniskuliah' => $request->kdjeniskuliah,
            'kdmateri' => $request->kdmateri,
            'keterangan' => $request->keterangan
        ]);

        // Handle updates for `dosen` and `kelas` relationships
        // Assuming that `dosen[]` and `kelas[]` are arrays of IDs from the form
        $dosenIds = $request->input('dosen', []);
        $kelasIds = $request->input('kelas', []);

        // Delete existing records in `gabung_timeline_dosen` for this timeline
        gabung_timeline_dosen::where('kdtimeline', $id)->delete();

        // Insert new records
        foreach ($dosenIds as $index => $kdperson) {
            $kdkelas = isset($kelasIds[$index]) ? $kelasIds[$index] : null;

            if ($kdperson && $kdkelas) {
                gabung_timeline_dosen::create([
                    'kdtimeline' => $id,
                    'kdperson' => $kdperson,
                    'kdkelas' => $kdkelas,
                ]);
            }
        }

        return redirect()->route("timeline.index", ['id' => $timeline->kdmatakuliah]);
    }
}
