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
      <div class="text1">
      <h3 >{{ $product->name }}</h3>
      <p>{{ $product->category->name }}</p>
    </div>
    </div>
      <div class="container" style="padding-top: 35px;">
        <div class="row" style="justify-content: center; font-family: Muli; font-size: 20px;"><div>Descriptions <br></div>
        <div style="font-family: muli; font-size: 15px; font-weight: lighter; padding-top: 20px;">{{$product->details}}<br>
        </div>  
      </div>
      <div class="avgrating">
        <span style="font-size: 35px; font-weight:bold;">{{ round($avgStar,2) }}</span>/5
      </div>
      <hr>
        <div class="feedbacks">
          <span>Product Reviews</span>
            @foreach ($ratings as $rating)
            <div class="review">  
              @for ($i = 0; $i < $rating->star; $i++)
              <img src="/images/star.png" height="25" width="25">
              @endfor
              <div class="text1" style="color: rgb(119, 118, 118);">{{ $rating->user->name}}</div>
              <div class="text1">
                <form action="/rating/{{$rating->id}}/edit" method="POST">
                  @csrf 
                  <input type="hidden" name="slug" value={{$product->slug}}>
                  <b><input type="text" name="comment" value="{{ $rating->comment }}" 
                    @if (Auth::user()->id == $rating->user->id) id="comment" @endif readonly></b>
                  @if (Auth::user()->id == $rating->user->id)
                    <button type="submit" class="btn btn-primary" onclick="edit(event);">Edit</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>

                @endif
                </form>
                
              </div>
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
<script>
  function edit(event){
    var textInp = document.getElementById('comment');
    textInp.removeAttribute('readonly');
    textInp.focus();
    textInp.select();
    event.preventDefault();
  }
</script>
  
@endsection
