<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_timeline extends Model
{
    use HasFactory;

    protected $guarded = ['kdtimeline'];

    protected $table = 'ak_timeline';
    protected $primaryKey = 'kdtimeline';
}
