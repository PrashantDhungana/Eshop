<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

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
        // if(session('order_id'))
        // $orderItem =Order::find(session('order_id'))->delete();
        // dd($orderItem);
        // if(OrderItem::truncate())
        //     Order::truncate();
        // dd($result);
        $order = Order::find(session('order_id'));
        $order->orderItems()->delete();
        $order->delete();
        
        Auth::logout();
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        

        return redirect('/');
    }
}
