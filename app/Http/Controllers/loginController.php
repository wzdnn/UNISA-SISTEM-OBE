<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index() {
        return view("login.index");
    }

    function login(Request $request)
    {
        // proses validasi
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);


        $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];


        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'ADMIN'){
                return redirect()->route('index.VM');
                // echo "sukses";
                // exit();
            } elseif (Auth::user()->role == 'USER'){
                return redirect()->route('index.VMU');
            }


        } else {
            return redirect('')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }


    }

    function logout() {
        Auth::logout();
        return redirect('');
    }
}


