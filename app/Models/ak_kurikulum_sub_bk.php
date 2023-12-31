<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_sub_bk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_subbk',
        'sub_bk',
        'referensi',
        'kdbk',
        'kdkurikulum'
    ];

    public function SBKtoMK()
    {
        return $this->belongsToMany(ak_matakuliah::class, 'ak_matakuliah_ak_kurikulum_sub_bk', 'ak_kurikulum_sub_bk_id', 'kdmatakuliah')->withTimestamps();
    }

    public function SBKtoidCPMK()
    {
        return $this->belongsToMany(ak_kurikulum_cpmk::class, 'gabung_subbk_cpmks', 'id_gabung_subbk', 'id_cpmk');
    }
    public function getSBKtoidCPMK()
    {
        return $this->belongsToMany(ak_matakuliah::class, 'ak_matakuliah_ak_kurikulum_sub_bk', 'kdmatakuliah', 'ak_kurikulum_sub_bk_id')->withPivot('id');
    }
}
