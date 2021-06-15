<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class CheckoutController extends Controller
{
    //
    public function index(){
        $order = Order::firstorFail();
        return view('checkout',compact('order'));
    }
}
