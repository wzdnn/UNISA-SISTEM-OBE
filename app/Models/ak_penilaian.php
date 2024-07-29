<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_penilaian extends Model
{
    use HasFactory;

    protected $fillable = ['nilai'];

    public $timestamp = 'false';
    protected $table = 'ak_penilaian';

    public function export(int $id)
    {
        $penilaian = ak_penilaian::select("ak_penilaian.nilai as apnilai", "ak_penilaian.id as kdpen", "gnm.kdjenisnilai as kdjn", "nim", "namalengkap", "ak_penilaian.kdkrsnilai")
            ->join("ak_krsnilai as krs", "krs.kdkrsnilai", "=", "ak_penilaian.kdkrsnilai")
            ->join("ak_mahasiswa as mhs", "mhs.kdmahasiswa", "=", "krs.kdmahasiswa")
            ->join("pt_person as per", "per.kdperson", "=", "mhs.kdperson")
            ->join("gabung_nilai_metopen as gnm", "gnm.kdjenisnilai", "=", "ak_penilaian.kdjenisnilai")
            ->where("gnm.kdjenisnilai", "=", $id)
            ->get();

        return $penilaian;
    }
}
