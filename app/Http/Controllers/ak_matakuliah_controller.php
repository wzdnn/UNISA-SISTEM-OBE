<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ak_matakuliah_controller extends Controller
{
    //
    public function matakuliahIndex()
    {
        $ak_matakuliah = DB::table('ak_matakuliah')
            ->select('ak_matakuliah.*')
            ->get();
        return view('pages.matakuliah.index', compact('ak_matakuliah'));
    }
}
