<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            /* 
            $cart->cart_num = $cart_id;
            $cart->product_id = $id;
            $cart->product_name = $product->name ;
            $cart->price = $product->price ;
            $cart->status = 1 ;
            $cart->quantity = 1;
            */
            $table->string('cart_num');
            $table->foreignId('product_id')->constrained();
            $table->string('product_name');
            $table->float('price');
            $table->boolean('status')->default(0);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
