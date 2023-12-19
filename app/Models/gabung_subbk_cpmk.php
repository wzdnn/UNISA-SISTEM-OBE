<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_subbk_cpmk extends Model
{
    use HasFactory;

    protected $table = "gabung_subbk_cpmks";

    public function cpmk()
    {
        return $this->hasOne(ak_kurikulum_cpmk::class, 'id', 'id_cpmk');
    }

    public function CPMKtoMTP()
    {
        return $this->belongsToMany(metode_penilaian::class, 'gabung_metopen_cpmks', 'id_gabung_cpmk', 'id_metopen')->withPivot('id', 'bobot');
    }
}
