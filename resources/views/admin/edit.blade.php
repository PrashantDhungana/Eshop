@extends('admin.layout')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@can('update-product', $product)
  
  <div class="container">
    <form action="{{ route('products.update',$product->slug) }}" method="POST">
      @method('PUT')
      @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Product Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product name" name="product_name" value="{{$product->name}}" @error('title') style="border:2px solid red" @enderror>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Enter product description">{{$product->details}}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Old Price</label>
        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price" name="old_price" value="{{$product->new_price}}" readonly required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">New Price</label>
        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price" name="new_price" required>
      </div>
      <select class="form-select" aria-label="Default select example" name="cat_name" required>
        <option>Select Category</option>
        @foreach ($categories as $category)
        <option value="{{$category->id}}" 
          {{ $category->id == $product->category->id ? 'selected':'' }}
          >{{$category->name}}</option>     
          @endforeach
        </select>
        <div class="form-group">
          <label for="exampleFormControlFile1">Upload Product image</label>
          <input type="file" class="form-control-file" id="exampleFormControlFile1" name="product_img">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    @else 
    <div class="container alert-danger text-danger">
      You are not Authorized to update this product. <a href="{{ route('products.index')}}">Go Back !!!</a>
    </div>
  @endcan
@endsection