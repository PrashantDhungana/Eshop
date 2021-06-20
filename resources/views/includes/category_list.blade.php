<?php 
use App\Models\Category;

$categories = Category::whereNull('parent_id')->get();

?>
<div class="search-bar-top">
    <div class="search-bar">
        <form action="/search">
            <select name="category">
                <option selected="selected" value="">All Category</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{$item->name}}</option>
                    @endforeach
            </select>
                <input name="search" placeholder="Search Products Here....." type="search">
                <button class="btnn"><i class="ti-search"></i></button>
        </form>
    </div>
</div>