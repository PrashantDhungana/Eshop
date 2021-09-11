<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_items = Cart::all();
        return view('cart',compact('order_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
        $id = $request->product_id;
        $cart_id = session()->get('cartid');
        $product_exist= Cart::where('cart_num',$cart_id)->Where('product_id',$id)->first();
        if(!$cart_id) {
            $cart_id= uniqid();
            session()->put('cartid', $cart_id);
        }

         $product = Product::findOrFail($id);

        if($product_exist){
            $product_exist->quantity = $product_exist->quantity+1;
            $product_exist->save();
            $product_exist->sub_total = $product_exist->price * $product_exist->quantity;
            $product_exist->save();
        }
        else{
            $cart = new Cart;
            $cart->cart_num = $cart_id;
            $cart->product_id = $id;
            $cart->product_name = $product->name ;
            $cart->price = $product->new_price ;
            $cart->status = 1 ;
            $cart->quantity = 1;
            $cart->sub_total = $product->new_price;
            $cart->save();
        }


        
        return redirect('cart');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $cart_id = session()->get('cartid');

        $CartItem = Cart::find($id);
        $CartItem->delete();
        return redirect()->back()->with('success','The item was deleted successfully.');
    }
}
