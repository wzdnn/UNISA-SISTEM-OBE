<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    // method login index
    public function index()
    {
        return view("login.index");
    }

    // method login page
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

    //method login logout
    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
