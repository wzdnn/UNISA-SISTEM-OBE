<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_mk_cpmk extends Model
{
    use HasFactory;

    protected $table = "ak_matakuliah_cpmk";

    public function CPMKtoMTP()
    {
        return $this->belongsToMany(metode_penilaian::class, 'gabung_metopen_cpmks', 'id_gabung_cpmk', 'id_metopen')->withPivot('id', 'bobot');
    }
}
