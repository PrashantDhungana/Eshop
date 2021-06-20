@extends('admin.layout')
@section('content')
    <div class="container">
        <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category name" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Category description" name="description"></textarea>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection