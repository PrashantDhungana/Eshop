<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $rating = new Rating;

        $request->validate([
            'star' => 'max:5|min:1|required',
            'comment' => 'max:255|required',
        ]);
        $rating->star = $request->star;
        $rating->comment = $request->comment;
        $rating->product_id = $request->product_id;
        $rating->user_id = Auth::user()->id;
        if($rating->save()) return redirect()->route('product.show',$slug)->with('success','Rating Added Successfully');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'comment' => 'required|max:255'
        ]);
        $rating = Rating::find($id);
        $rating->comment = $request->comment;
        if($rating->save()) return redirect()->route('product.show', $request->slug)->with('success','Rating edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
