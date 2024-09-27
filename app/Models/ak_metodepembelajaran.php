<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_metodepembelajaran extends Model
{
    use HasFactory;

    protected $table = 'simptt.ak_metodepembelajaran';
    protected $guarded = ['kdmetodepembelajaran'];
    protected $primaryKey = 'kdmetodepembelajaran';

    public function pembelajaran()
    {
        return $this->hasMany(gabung_cpmk_pembelajaran::class, 'id_pembelajaran', 'kdmetodepembelajaran');
    }
}
