<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $categories = new Category;
       $this->authorize('create', $categories);

       $request->validate([
        'name' => 'required|unique:categories',
        'description' => 'required|max:255'
       ]);
    
       $categories->name = $request->name;
       $categories->description = $request->description;
       $categories->slug = Str::slug($categories->name);
       
       if($categories->save()) return redirect()->route('categories.index')->with('success','New Category created Successfully');
       else return "failed";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstorFail();
        $this->authorize('update', $category);
        return view('admin.category.edit', compact('category'));
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
        $category = Category::where('slug', $slug)->firstorFail();
        $this->authorize('update', $category);
        $request->validate([
            'name' => 'required|unique:categories',
            'description' => 'required|max:255'
           ]);
        
        
       $category->name = $request->name;
       $category->description = $request->description;
       $category->slug = Str::slug($category->name);
       
       if($category->save()) return redirect()->route('categories.index')->with('success','Category edited Successfully');
       else return "Failed";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstorFail();
        $this->authorize('delete', Category::class);
        if($category->delete()) return redirect()->route('categories.index')->with('success','Category Deleted Successfully!!!');
    }
}
