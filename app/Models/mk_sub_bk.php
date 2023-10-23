<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mk_sub_bk extends Model
{
    use HasFactory;
    protected $table = 'ak_matakuliah_ak_kurikulum_sub_bk';

    protected $fillable = [
        'pokok_bahasan',
        'kuliah',
        'tutorial',
        'seminar',
        'praktikum',
        'skill_lab',
        'field_lab',
        'praktik'
    ];
}
