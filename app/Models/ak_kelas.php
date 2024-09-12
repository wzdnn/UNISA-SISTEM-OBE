<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kelas extends Model
{
    use HasFactory;

    protected $guarded = ['kdkelas'];

    protected $table = 'ak_kelas';
    protected $primaryKey = 'kdkelas';
}
