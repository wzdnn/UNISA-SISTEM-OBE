<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_cpmk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_cpmk',
        'cpmk'
    ];
}
