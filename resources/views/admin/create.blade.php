@extends('admin.layout')
@section('content')
<div class="container">
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product name" name="product_name" @error('title') style="border:2px solid red" @enderror value="{{old('product_name')}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Enter product description">{{old('description')}}</textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price" name="price" value="{{old('price')}}">
  </div>
  <select class="form-select" aria-label="Default select example" name="cat_name" required>
    <option selected>Select Category</option>
    @foreach ($categories as $category)
      <option value="{{$category->id}}" 
        {{ $category->id == old('cat_name') ? 'selected':'' }}>{{$category->name}}</option>     
    @endforeach
  </select>
  <div class="form-group">
    <label for="exampleFormControlFile1">Upload Product image</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="product_img">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection