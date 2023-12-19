<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_matakuliah_subbk extends Model
{
    use HasFactory;

    protected $table = "ak_matakuliah_ak_kurikulum_sub_bk";

    public function subbk()
    {
        return $this->hasOne(ak_kurikulum_sub_bk::class, "id", "ak_kurikulum_sub_bk_id");
    }

    public function cpmks()
    {
        return $this->belongsToMany(ak_kurikulum_cpmk::class, "gabung_subbk_cpmks", "id_gabung_subbk", "id_cpmk")->withPivot("id");
    }
}
