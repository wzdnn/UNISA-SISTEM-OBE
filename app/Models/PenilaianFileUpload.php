<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianFileUpload extends Model
{
    use HasFactory;

    protected $table = "penilaian_file_upload";

    protected $guarded = [
        'id'
    ];
}
