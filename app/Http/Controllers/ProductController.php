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
        // dd($products);
        return view('index',compact('products'));
    }

   
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstorFail();
        $ratings = Rating::where('product_id', $product->id)->get();

        $starSum = $ratings->pluck('star')->sum();
        $avgStar = $ratings->pluck('star')->avg();
        // return $product;
        return view('show-product',compact('product','ratings','avgStar','starSum'));
    }

    public function search(Request $request){

        // if($request->news !== NULL{

        // }
        if($request->price !== NULL){
            $minPrice = $this->trimPrice($request->price)[0];
            $maxPrice = $this->trimPrice($request->price)[1];
        }
        else{
            $minPrice = 0;
            $maxPrice = 50000;

        }
        // dd($request->price);
        $categories = Category::latest()->get();
        $results = Product::categoryid($request->category)
        ->search($request->search)
        ->price($minPrice,$maxPrice)
        ->get();
        return view('search',compact('results','categories'));

        // $products = Product::latest();
        // $categories = Category::latest()->get();
        // if(request('search') !== NULL)
        // {
        //     $products->where('name', 'like','%'.request('search').'%')
        //             ->orWhere('details', 'like','%'.request('search').'%')
        //             ->orWhere('new_price', 'like','%'.request('search').'%'); 
        // }
        // dump($products->get());

        // // dd(request('category'));
        // if(request('category') !== NULL)
        // {
        //     $products->where('category_id',request('category'));
        // }
        // dump($products->get());

        // $results = $products->get();

        
        // // return $categories;
        // return view('search',compact('results','categories'));`
    }

    public function trimPrice($data){
        $data = explode('-',str_replace(' ', '', $data));
        $min = str_replace('Rs.','', $data[0]);
        $max = str_replace('Rs.','', $data[1]);
        return [$min,$max];

    }
}
