<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_sub_bk_materi extends Model
{
    use HasFactory;

    protected $table = 'ak_kurikulum_sub_bk_materi';
    // protected $guarded = ['id'];
    protected $primarykey = 'id';

    protected $fillable = [
        'id_gabung',
        'kdtahunakademik',
        'materi_pembelajaran'
    ];
}
