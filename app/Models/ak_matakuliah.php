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
        'mk_singkat',
        'isObe',
        'batasNilai'
    ];

    protected $table = 'ak_matakuliah';
    protected $primaryKey = "kdmatakuliah";

    public function MKtoSBKread()
    {
        return $this->belongsToMany(ak_kurikulum_sub_bk::class, 'ak_matakuliah_ak_kurikulum_sub_bk', 'kdmatakuliah', 'ak_kurikulum_sub_bk_id', 'kdmatakuliah', 'id')->withPivot(['id', 'pokok_bahasan', 'kuliah', 'tutorial', 'seminar', 'praktikum', 'skill_lab', 'field_lab', 'praktik'])->withTimestamps();
    }

    public function MKtoSBKinput()
    {
        return $this->belongsToMany(ak_kurikulum_sub_bk::class, 'ak_matakuliah_ak_kurikulum_sub_bk', 'kdmatakuliah', 'ak_kurikulum_sub_bk_id')->withTimestamps();
    }

    // gabungan sub bk dengan matkul
    public function MKtoSub_bk()
    {
        return $this->belongsToMany(ak_kurikulum_sub_bk::class, 'ak_matakuliah_ak_kurikulum_sub_bk', 'kdmatakuliah', 'ak_kurikulum_sub_bk_id')->withPivot('id');
    }

    public function GetAllidSubBK()
    {
        return $this->hasMany(gabung_matakuliah_subbk::class, 'kdmatakuliah', 'kdmatakuliah');
    }
}
