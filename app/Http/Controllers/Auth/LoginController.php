<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\VerifyPass;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;



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
    public function forgetpass(){

        return view('auth.forgetpassword');
    }
    public function password_r(Request $request){

        $user = User::where($request->id)->first();
        $token = VerifyPass::create([
            'user_id' => $user->id,
            'token' =>Str::random(60)
        ]);

        Mail::to($request->email)->send(new PasswordReset($token->token, $user->name));
        return redirect()->back()->with(['sucess' => 'Reset code sent to your email']);


    }
    public function VerifyPassToken($token){
        $token = VerifyPass::where('token' , $token)->first();
        if($token){
            $user = User::findOrFail($token->user_id);
        }
        return view('auth.resetpassword');

    }
    public function update(Request $request , $token){
        $verify = VerifyPass::where('token' ,$token)->first();
        $user = $verify->user;
        // dd($user);
        $request->validate([
            'password'=>'required|confirmed'
        ]);
        
       $user -> password = Hash::make($request->password);
       if($user->save()) return redirect()->intended('login');




    }
}
