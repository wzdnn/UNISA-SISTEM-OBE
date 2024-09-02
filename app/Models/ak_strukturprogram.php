<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_strukturprogram extends Model
{
    use HasFactory;

    protected $table = "ak_strukturprogram";
    protected $guarded = [
        'kdstrukturprogram'
    ];
    protected $primaryKey = "kdstrukturprogram";


    public function struktur_utama()
    {
        return $this->belongsToMany(pt_person::class, 'ak_matakuliah_dosen_utama', 'kdstrukturprogram', 'kdperson', 'kdstrukturprogram', 'kdperson');
    }

    public function struktur_pelaporan()
    {
        return $this->belongsToMany(pt_person::class, 'ak_matakuliah_dosen_pelaporan', 'kdstrukturprogram', 'kdperson', 'kdstrukturprogram', 'kdperson');
    }
}
