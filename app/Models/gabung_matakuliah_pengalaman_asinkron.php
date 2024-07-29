<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_matakuliah_pengalaman_asinkron extends Model
{
    use HasFactory;

    protected $table = 'gabung_matakuliah_pengalaman_asinkron';

    public function asinkron_pivot()
    {
        return $this->hasMany(ak_pengalamanmahasiswa::class, 'id', 'id_pengalaman');
    }
}
