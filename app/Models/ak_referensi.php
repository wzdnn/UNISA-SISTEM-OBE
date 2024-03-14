<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_referensi extends Model
{
    use HasFactory;

    protected $table = 'ak_referensi';

    protected $guarded = ['kdreferensi'];

    protected $primaryKey = 'kdreferensi';


    public function referensiUtama()
    {
        $matakuliah = ak_matakuliah::all();

        // return $matakuliah->belongsToMany($this, 'ak_matakuliah_referensi_utama', 'kdmatakuliah', 'id_referensi');

        // return $this->belongsToMany(ak_matakuliah::class, 'ak_matakuliah_referensi_utama', 'kdmatakuliah', 'id_referensi');
    }
}
