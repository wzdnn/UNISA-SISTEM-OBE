<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_strukturprogram extends Model
{
    use HasFactory;

    protected $table = "ak_strukturprogram";

    protected $guarded = [
        'kdstrukturprogram'
    ];
}
