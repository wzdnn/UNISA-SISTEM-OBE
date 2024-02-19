<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_pengalamanmahasiswa extends Model
{
    use HasFactory;

    protected $table = 'ak_pengalamanmahasiswa';
    protected $fillable = [
        'pengalaman_mahasiswa'
    ];

    public function pengalamanSinkron()
    {
        return $this->hasMany(gabung_matakuliah_pengalaman_sinkron::class, 'id_pengalaman', 'id');
    }

    public function pengalamanAsinkron()
    {
        return $this->hasMany(gabung_matakuliah_pengalaman_asinkron::class, 'id_pengalaman', 'id');
    }
}
