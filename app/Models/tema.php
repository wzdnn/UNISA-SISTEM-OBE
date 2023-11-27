<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tema extends Model
{
    use HasFactory;

    protected $fillable = [
        'tema',
        'semester',
        'kdkurikulum'
    ];

    protected $primarykey = 'id';

    protected $table = 'temas';
}
