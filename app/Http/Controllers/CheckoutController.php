<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController extends Controller
{
    //
    public function index(){
        $order_id = session()->get('cartid');

        $order = Cart::where('cart_num', $order_id)->get();
        return view('checkout',compact('order'));
    }

    public function store(Request $request){
        return $request;
    }
}
