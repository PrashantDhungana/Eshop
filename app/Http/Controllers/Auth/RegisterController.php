<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        $token = VerifyMail::create([
            'user_id' => $user->id,
            'token' =>Str::random(60)
        ]);

        Mail::to($request->email)->send(new VerifyEmail($request->name,$token->token));

        return view('auth.emailsentinfo',['id' => $user->id]);
    }

    public function VerifyToken($token){
        $token = VerifyMail::where('token',$token)->first();
        if($token){
            $user = User::findOrFail($token->user_id);
            if(!$user->email_verified_at)
            {
                $user->email_verified_at = Carbon::now();
                $user->save();
            }
            // Auth::login($user);
            return redirect()->intended('login');
        }
        else
            abort(404);
        
    }

    public function resendMail($id){
        $resend = VerifyMail::where('user_id',$id)->first();
        $token = $resend->token;
        Mail::to($resend->user->email)->send(new VerifyEmail($resend->user->name,$token));
        return view('auth.emailsentinfo',compact('id'));
    }
}
