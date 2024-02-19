<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_metodepembelajaran extends Model
{
    use HasFactory;

    protected $table = 'ak_metodepembelajaran';

    public function pembelajaran()
    {
        // return $this->belongsToMany(ak_metodepembelajaran::class, 'gabung_cpmk_pembelajarans', 'id_gabung_cpmk', 'id_pembelajaran');
        return $this->hasMany(gabung_cpmk_pembelajaran::class, 'id_pembelajaran', 'id');
    }
}
