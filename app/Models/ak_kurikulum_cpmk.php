<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_cpmk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_cpmk',
        'cpmk',
        'kdkurikulum'
    ];

    protected $primarykey = 'id';

    public function CPMKtoCPL()
    {
        return $this->belongsToMany(ak_kurikulum_cpl::class, 'ak_kurikulum_cpl_ak_kurikulum_cpmk', 'ak_kurikulum_cpmk_id', 'ak_kurikulum_cpl_id')->withTimestamps();
    }

    public function metopens()
    {
        return $this->hasMany(gabung_subbk_cpmk::class, 'id_cpmk', 'id');
    }
}
