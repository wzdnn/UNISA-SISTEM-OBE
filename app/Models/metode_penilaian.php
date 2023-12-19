<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metode_penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'metode_penilaian'
    ];

    public function MTPtoCPMK()
    {
        return $this->belongsToMany(ak_kurikulum_cpmk::class, 'gabung_metopen_cpmks', 'id_gabung_cpmk', 'id_metopen');
    }
}
