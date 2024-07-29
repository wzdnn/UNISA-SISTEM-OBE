<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_sub_bk_materi extends Model
{
    public $table = 'ak_kurikulum_sub_bk_materi';
    protected $primaryKey = 'kdmateri';
    protected $guarded = ['kdmateri'];

    // protected $fillable = [
    //     'id_gabung',
    //     'kdtahunakademik',
    //     'materi_pembelajaran'
    // ];
}
