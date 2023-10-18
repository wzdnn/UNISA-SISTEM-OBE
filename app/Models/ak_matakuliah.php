<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodematakuliah',
        'matakuliah',
        'kdkurikulum',
        'semester',
        'mk_singkat',
        'isObe'
    ];

    public $table = 'ak_matakuliah';

    public function MKtoSBK()
    {
        return $this->belongsToMany(ak_kurikulum_sub_bk::class, 'ak_matakuliah_ak_kurikulum_sub_bk', 'kdmatakuliah', 'ak_kurikulum_sub_bk_id', 'kdmatakuliah', 'id')->withTimestamps();
    }
}
