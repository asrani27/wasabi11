<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function handle()
    {
        event(new Registered($user));
    }

    public function index()
    {
        return view('register');
    }
    public function store(Request $req)
    {
        $req->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]); 

        $user = new User();
        $user->name = $req->nama;
        $user->username = $req->username;
        $user->email = $req->email;
        $user->roles = 'user';
        $user->password = Hash::make($req->password);
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect('/email/verify')
            ->with('success', 'Verification link sent!');
    }
}
