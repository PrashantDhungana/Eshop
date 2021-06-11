<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('index',\compact('products'));
    }

   
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstorFail();
        $ratings = Rating::where('product_id', $product->id)->get();
        // return $product;
        return view('show-product',compact('product','ratings'));
    }
}
