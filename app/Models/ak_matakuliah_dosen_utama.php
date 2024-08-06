<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_matakuliah_dosen_utama extends Model
{
    use HasFactory;

    protected $table = 'ak_matakuliah_dosen_utama';

    protected $guarded = ['kdgabungutama'];

    protected $primaryKey = 'kdgabungutama';

    public function utama_dosen()
    {
        return $this->hasMany(ak_dosen::class, 'kdperson', 'kdperson');
    }
}
