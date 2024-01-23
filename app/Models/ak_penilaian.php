<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_penilaian extends Model
{
    use HasFactory;

    protected $fillable = ['nilai'];


    protected $table = 'ak_penilaian';
}
