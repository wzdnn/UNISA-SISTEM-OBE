<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_matakuliah_pengalaman_sinkron extends Model
{
    use HasFactory;

    protected $table = 'gabung_matakuliah_pengalaman_sinkron';

    public function sinkron_pivot()
    {
        return $this->hasMany(ak_pengalamanmahasiswa::class, 'id', 'id_pengalaman');
    }
}
