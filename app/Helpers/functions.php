<?php
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

if(!function_exists('merofunc')){
    function merofunc(Request $request){
        return Image::make($request->file('product_img'))->resize(550, 750 );
    }
}