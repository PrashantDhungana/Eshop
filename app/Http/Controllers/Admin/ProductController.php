<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
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
        return view('admin.index',compact('products'));
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'product_name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|integer',
            'cat_name' => 'required|integer|min:1',
            'product_img' => 'image',
        ]);   
        
        if($request->hasFile('product_img')){

            $img = Image::make($request->file('product_img'))->resize(550, 750 );

            $imgExt = $request->file('product_img')->getClientOriginalExtension();
            
            $fullname = uniqid().time().".".$imgExt;
            
            $img->save(storage_path('app/public/images/').$fullname);
                
        }else{
            $fullname = 'default.png';
        }

        merofunc("Hehe");
        
        $product = new Product;
        $product->name = $request->product_name; 
        $product->details  = $request->description;
        $product->new_price = $request->price;
        $product->slug = Str::slug($request->product_name, '-');
        $product->category_id = $request->cat_name;
        $product->image = $fullname;

        if($product->save()) return redirect()->route('products.index')->with('success','Product inserted successfully');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($slug)
    // {
    //     $product = Product::where('slug', $slug)->firstorFail();
    //     // return $product;
    //     return view('show-product',compact('product'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::all();
        $product = Product::where('slug', $slug)->firstorFail();
        return view('admin.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'product_name' => 'required',
            'description' => 'required|max:255',
            'new_price' => 'required|numeric',
            'cat_name' => 'required|numeric',
            // 'product_img' => 'image',
        ]); 
        $product = Product::where('slug',$slug)->firstorFail();
        $product->name = $request->product_name; 
        $product->details  = $request->description;
        $product->old_price = $request->old_price;
        $product->new_price = $request->new_price;
        $product->slug = Str::slug($request->product_name, '-');
        $product->category_id = $request->cat_name;

        if($product->save()) return redirect()->route('products.index')->with('success','Product edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $result = Product::where('slug',$slug)->delete();
        if($result) return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
