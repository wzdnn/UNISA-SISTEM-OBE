<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pt_person extends Model
{
    use HasFactory;

    protected $table = 'pt_person';

    protected $guarded = ['kdperson'];

    public function person_utama()
    {
        return $this->hasMany(ak_matakuliah_dosen_utama::class, 'kdperson', 'kdperson');
    }
    public function person_pelaporan()
    {
        return $this->hasMany(ak_matakuliah_dosen_pelaporan::class, 'kdperson', 'kdperson');
    }
}
