<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use DerekCodes\TurnstileLaravel\TurnstileLaravel;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/user/home');
        }
        return view('login');
    }
    public function login(Request $req)
    {
        if ($req->get('cf-turnstile-response') == null) {

            return back()->with('captcha', 'Checklist Captcha');
        } else {
            $turnstile = new TurnstileLaravel;
            $response = $turnstile->validate($req->get('cf-turnstile-response'));

            if ($response['status'] == true) {

                $remember = $req->remember ? true : false;
                $credential = $req->only('username', 'password');

                if (Auth::attempt($credential, $remember)) {

                    if (Auth::user()->roles == 'user') {
                        return redirect('/user/home');
                    } else
                        Session::flash('success', 'Selamat Datang');
                    return 'role lain';
                }
            } else {
                $req->flash();
                return back()->with('error', 'Wrong Username Or Password');
            }
        }
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/user/home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => encrypt('admin@123')
                ]);
                $newUser->markEmailAsVerified();
                Auth::login($newUser);

                return redirect('/user/home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
