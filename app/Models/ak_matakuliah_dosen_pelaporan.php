<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_matakuliah_dosen_pelaporan extends Model
{
    use HasFactory;

    protected $table = "ak_matakuliah_dosen_pelaporan";

    protected $guarded = ['kdgabungpelaporan'];

    protected $primaryKey = 'kdgabungpelaporan';

    public function pelaporan_dosen()
    {
        return $this->hasMany(ak_dosen::class, 'kdperson', 'kdperson');
    }
}
