<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_cpl extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_cpl',
        'cpl',
        'deskripsi_cpl',
        'kdaspek',
        'kdkurikulum'
    ];

    public function CpltoPl()
    {
        // return $this->belongsToMany('App\Models\ak_kurikulum_pl')->withTimestamps();
        return $this->belongsToMany(ak_kurikulum_pl::class, 'ak_kurikulum_cpl_ak_kurikulum_pl', 'ak_kurikulum_cpl_id', 'ak_kurikulum_pl_id')->withTimestamps();
    }

    public function CpltoCplr()
    {
        // return $this->belongsToMany('App\Models\ak_kurikulum_cplr')->withTimestamps();
        return $this->belongsToMany(ak_kurikulum_cplr::class, 'ak_kurikulum_cpl_ak_kurikulum_cplr', 'ak_kurikulum_cpl_id', 'ak_kurikulum_cplr_id')->withTimestamps();
    }

    public function CpltoCpmk()
    {
        return $this->belongsToMany(ak_kurikulum_cpmk::class, 'ak_kurikulum_cpl_ak_kurikulum_cpmk', 'ak_kurikulum_cpl_id', 'ak_kurikulum_cpmk_id')->withTimestamps();
    }
}
