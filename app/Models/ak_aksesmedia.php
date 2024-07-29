<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_aksesmedia extends Model
{
    use HasFactory;
    protected $table = 'ak_aksesmedia';

    protected $primaryKey = "kdakses";

    protected $guarded = ['kdakses'];
}
