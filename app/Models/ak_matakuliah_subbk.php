<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_matakuliah_subbk extends Model
{
    use HasFactory;

    public $table = 'ak_matakuliah_ak_kurikulum_sub_bk';

    protected $guarded = ['id'];
}
