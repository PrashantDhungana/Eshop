<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
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
        return view('welcome',\compact('products'));
    }

   
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstorFail();
        // return $product;
        return view('show-product',compact('product'));
    }
}
