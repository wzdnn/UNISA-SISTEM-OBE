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

    public function pembelajaran()
    {
        return $this->belongsToMany(ak_metodepembelajaran::class, 'gabung_cpmk_pembelajarans', 'id_gabung_cpmk', 'id_pembelajaran');
        // return $this->hasMany(ak_metodepembelajaran::class, 'id', 'id_pembelajaran');
        // return $this->hasOne(ak_metodepembelajaran::class, 'id', 'id_pembelajaran');
    }

    public function subCpmk()
    {
        return $this->belongsToMany(ak_kurikulum_sub_cpmk::class, 'gabung_cpmk_subcpmk', 'id_gabung_cpmk', 'id_subcpmk');
    }
}
