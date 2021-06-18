<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    //
    public function index(){
        $order_id = session('order_id', 0);

        $order = Order::where('id', $order_id)->get();
        return view('checkout',compact('order'));
    }

    public function store(Request $request){
        return $request;
    }
}
