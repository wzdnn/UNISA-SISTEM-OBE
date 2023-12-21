<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_metopen_cpmk extends Model
{
    use HasFactory;

    protected $table = "gabung_metopen_cpmks";

    protected $fillable = [
        'bobot'
    ];
}
