<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_cplr extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_cplr',
        'cplr',
        'deskripsi_cplr',
        'kdaspek',
        'kdsumber',
        'kdkurikulum'
    ];
}
