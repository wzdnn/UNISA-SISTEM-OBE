<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
        return view("login.index");
    }

    // function login(Request $request)
    // {
    //     // proses validasi
    //     $request->validate([
    //         'email'=>'required',
    //         'password'=>'required',
    //     ]);


    //     $infologin = [
    //         'email'=> $request->email,
    //         'password'=> $request->password,
    //     ];


    //     if(Auth::attempt($infologin)){
    //         if(Auth::user()->role == 'admin'){
    //             return redirect('dashboard');
    //             // echo "sukses";
    //             // exit();
    //         } elseif (Auth::user()->role == 'universitas'){
    //             return redirect('universitas');
    //         } elseif (Auth::user()->role == 'prodi'){
    //             return redirect('prodi');
    //         }


    //     } else {
    //         return redirect('')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
    //     }

    // }
    function login(Request $request)
    {
        // Validation: Ensure both email and password are entered
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Prepare login credentials
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Attempt to login
        if (Auth::attempt($infologin)) {
            // Check user role and redirect accordingly
            if (Auth::user()->role == 'admin') {
                return redirect('dashboard');
            } elseif (Auth::user()->role == 'universitas') {
                return redirect('universitas');
            } elseif (Auth::user()->role == 'prodi') {
                return redirect('prodi');
            }
        } else {
            // Incorrect credentials
            return back()->withErrors(['login_error' => 'Username dan password yang dimasukkan tidak sesuai'])->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
