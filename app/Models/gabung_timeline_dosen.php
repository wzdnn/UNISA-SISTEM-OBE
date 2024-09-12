<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_timeline_dosen extends Model
{
    use HasFactory;

    protected $guarded = ['kdgabungtl'];

    protected $table = 'gabung_timeline_dosen';
    protected $primaryKey = 'kdgabungtl';
}
