<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gabung_user extends Model
{
    use HasFactory;

    // deklarasikan sementara buat PT unit Kerja

    protected $table = "pt_unitkerja";
    protected $primaryKey = "kdunitkerja";
}
