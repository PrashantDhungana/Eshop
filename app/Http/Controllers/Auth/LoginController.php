<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {   
        Auth::logout();
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        

        return redirect('/');
    }

    public function SocialRedirect(){
        return Socialite::driver('github')->redirect();
    }

    public function SocialCallback(){
        $user = Socialite::driver('github')->user();
        
        $user = User::firstOrCreate([
            'email' => $user->email
        ],
        
        [
            'email' => $user->email,
            'name' => $user->name,
            'password' => Hash::make(Str::random(60))
        ]);

        Auth::login($user, true);

        return redirect('product');

    }
}
