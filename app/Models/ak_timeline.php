<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_timeline extends Model
{
    use HasFactory;

    protected $guarded = ['kdtimeline'];

    protected $table = 'ak_timeline';
    protected $primaryKey = 'kdtimeline';

    public function dosen()
    {
        return $this->hasManyThrough(
            'App\Models\pt_person', // Dosen model
            'App\Models\gabung_timeline_dosen', // Intermediate model (gabung_timeline_dosen)
            'kdtimeline', // Foreign key on the intermediate model
            'kdperson', // Foreign key on the Dosen model
            'kdtimeline', // Local key on the ak_timeline model
            'kdperson' // Local key on the intermediate model
        );
    }

    public function kelas()
    {
        return $this->hasManyThrough(
            'App\Models\ak_kelas', // Kelas model
            'App\Models\gabung_timeline_dosen', // Intermediate model
            'kdtimeline', // Foreign key on the intermediate model
            'kdkelas', // Foreign key on the Kelas model
            'kdtimeline', // Local key on the ak_timeline model
            'kdkelas' // Local key on the intermediate model
        );
    }
}
