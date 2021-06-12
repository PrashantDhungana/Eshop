@extends('layout')
@section('content')
  <style>
      .card{
          margin: 10px 10px 10px 10px;
      }
      .card-img-top{
         
      }
      
      </style>
      @if (session('success'))
          <div class="alert alert-success">{{session('success') }}</div>
      @endif
  <div class="project" style="border: 1px solid black;">
    <hr>
        
  <div class="container" style="padding-top: 20px;">

    <!-- Full-width images with number text -->
    <div class ="row">
        <div class="col-6">
        <img src="https://images.unsplash.com/photo-1580910051074-3eb694886505?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=401&q=80">
        </div>
    <div class="col-6">
      <div class="text1" style="padding-top: 30px">
      <h3  style="font-size: 30px">{{ $product->name }}</h3>
      <p>{{ $product->category->name }}</p>
      <div class="div">
        <h4>Description</h4>
        <p>{{$product->details}}</p>
      </div>
      <div class="but" style="padding-top: 20px">
        <button type="button" class="btn btn-warning" id="button">Buy Now</button>
        <button type="button" class="btn btn-danger" id="button2">Add to cart</button>

      </div>
    </div>
    </div>
     
        <div class="feedbacks">
          <span>Product Reviews</span>
            @foreach ($ratings as $rating)
            <div class="review">  
              @for ($i = 0; $i < $rating->star; $i++)
              <img src="/images/star.png" height="25" width="25">
              @endfor
              <div class="text1" style="color: rgb(119, 118, 118);">{{ $rating->user->name}}</div>
              <div class="text1"><b>{{ $rating->comment}}</b></div>
              </div>
                <hr>
            @endforeach
          
        </div>
      <div class="stars">
        <form action="/rating/{{$product->slug}}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{$product->id}}">
          <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
          <label class="star star-5" for="star-5"></label>
          <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
          <label class="star star-4" for="star-4"></label>
          <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
          <label class="star star-3" for="star-3"></label>
          <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
          <label class="star star-2" for="star-2"></label>
          <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
          <label class="star star-1" for="star-1"></label>
          
          <textarea name="comment" cols="30" rows="10" placeholder="Enter your feedback here"></textarea>
          <button type="submit" class="btn btn-primary">Rate</button>
        </form>
      </div>
    </div>
  </div>
  </div>

  
@endsection
