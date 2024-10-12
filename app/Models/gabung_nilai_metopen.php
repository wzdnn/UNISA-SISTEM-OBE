<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_nilai_metopen extends Model
{



    use HasFactory;
    protected $table = "gabung_nilai_metopen";
    protected $primaryKey = "kdjenisnilai";
    protected $guarded = ["kdjenisnilai"];
}
