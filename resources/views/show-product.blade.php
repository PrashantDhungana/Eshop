@extends('layout')
@section('content')
  <style>
      .card{
          margin: 10px 10px 10px 10px;
      }
      .card-img-top{
         
      }
      
      </style>
  <div class="project" style="border: 1px solid black;">
    <hr>
        
  <div class="container" style="padding-top: 20px;">

    <!-- Full-width images with number text -->
    <div class ="row">
        <div class="col-6">
        <!-- Img here -->
        </div>
    <div class="col-6">
      <div class="text1">
      <h3 >{{ $product->name }}</h3>
      <p>{{ $product->category->name }}</p>
    </div>
    </div>
      <div class="container" style="padding-top: 35px;">
        <div class="row" style="justify-content: center; font-family: Muli; font-size: 20px;"><div>Descriptions <br></div>
        </div>
        <div style="font-family: muli; font-size: 15px; font-weight: lighter; padding-top: 20px;">{{$product->details}}<br>
Made in Nepal</div>
    </div>
  </div>
  </div>
@endsection
