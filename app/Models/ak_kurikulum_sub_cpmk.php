<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ak_kurikulum_sub_cpmk extends Model
{
    use HasFactory;

    protected $table = 'ak_kurikulum_sub_cpmk';
    protected $primaryKey = 'kdsubcpmk';
    protected $guarded = ['kdsubcpmk'];

    public function subcpmk_get()
    {
        return $this->hasMany(gabung_cpmk_subcpmk::class, 'id_subcpmk', 'kdsubcpmk');
    }
}
