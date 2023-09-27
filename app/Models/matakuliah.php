<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'mk_singkat'
    ];

    public function MktoSBK()
    {

        return $this->belongsToMany(ak_kurikulum_sub_bk::class);
    }
}
