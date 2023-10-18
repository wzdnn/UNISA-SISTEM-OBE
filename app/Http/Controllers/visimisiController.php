<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class visimisiController extends Controller
{
    //

    public function vmIndex()
    {



        return view('pages.visidanmisi.index', compact('vm', 'misi'));
    }
}
