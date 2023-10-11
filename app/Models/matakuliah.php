<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matakuliah extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'kodematakuliah',
    //     'matakuliah',
    //     'mk_singkat',
    //     'kdkurikulum'
    // ];

    // public function MktoSBK()
    // {

    //     return $this->belongsToMany(ak_kurikulum_sub_bk::class, 'matakuliah_ak_kurikulum_sub_bk', 'matakuliah_id', 'ak_kurikulum_sub_bk_id')->withTimestamps();
    // }

    protected $fillable = [
        'kodematakuliah',
        'matakuliah',
        'mk_singkat',
        'kdkurikulum'
    ];

    // protected $table = 'ak_matakuliah';
}
