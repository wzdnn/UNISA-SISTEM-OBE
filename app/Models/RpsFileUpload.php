<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpsFileUpload extends Model
{
    use HasFactory;

    protected $table = "rps_file_upload";
    protected $primaryKey = 'kdfile';
    protected $guarded = ['kdfile'];
}
