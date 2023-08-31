<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_pl extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pl',
        'profile_lulusan',
        'deskripsi_profile',
        'kdkurikulum'
    ];
}
