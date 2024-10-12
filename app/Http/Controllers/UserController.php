<?php

namespace App\Http\Controllers;

use App\Models\gabung_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // method login
    public function login()
    {
        return view('pages.login');
    }

    // method Post Login
    public function postLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // Jika login berhasil
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');  // Redirect ke halaman home jika login berhasil
        } else {
            // Jika login gagal (email atau password salah), beri pesan error dan kembali ke form login
            return back()->withErrors(['login_error' => 'Email atau Password salah'])->withInput();
        }
    }

    // method logout
    public function logout()
    {
        Auth::logout();

        return redirect('');
    }
}
