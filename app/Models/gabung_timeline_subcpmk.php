<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_timeline_subcpmk extends Model
{
    use HasFactory;

    protected $table = 'gabung_timeline_subcpmk';
    protected $guarded = ['kdgabungtls'];
    protected $primaryKey = 'kdgabungtls';
}
