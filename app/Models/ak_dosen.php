<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_dosen extends Model
{
    use HasFactory;

    protected $table = 'ak_dosen';

    protected $guarded = ['kdperson'];
}
