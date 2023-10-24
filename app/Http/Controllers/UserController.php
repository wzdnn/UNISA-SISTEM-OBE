<?php

namespace App\Http\Controllers;

use App\Models\gabung_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        if (Auth::attempt(['email' => 'ti@gmail.com', 'password' => '123456'])) {
            // return dd('login sukses', Auth::user(), Auth::check());
            return redirect('/');
        }

        return dd('login gagal');
        // return view();
    }

    public function test()
    {
        // return dd(gabung_user::findOrFail(1));
        // $user = User::where('id', '=', Auth::id())->with('namaKdUnit')->get();
        // return dd($user, Auth::user()->unitkerja);
        // return dd(User::where('id', '=', Auth::id())->namaKdUnit());
        // return dd(auth()->user()->load('namaKdUnit')->namaKdUnit->unitkerja);
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);


        // if (Auth::attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
        // }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('');
    }
}
