<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        "kdmatakuliah",
        "mingguke",
        "kdtahunakademik",
        "kdcpmk",
        "kdmateri",
        "kdmetopem",
        "kdperson",
        "kdjeniskuliah"
    ];

    protected $table = 'ak_timeline';
}
