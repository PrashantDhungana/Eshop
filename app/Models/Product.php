<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Local Scopes
    public function scopeCategoryid($query,$category)
    {
        if(!Empty($category)){
            return $query->where('category_id',$category);
        }
        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if(!Empty($query)){
            return $query->where('name', 'like','%'.$search.'%')
                        ->orWhere('details', 'like','%'.$search.'%')
                        ->orWhere('new_price', 'like','%'.$search.'%'); 
        }
        return $query;
    }

    public function scopePrice($query, $min, $max)
    {
        if(!Empty($query)){
            return $query->whereBetween('new_price', [$min, $max]); 
        }
        return $query;
    }

}
