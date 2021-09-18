<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <div class="">
     <form action="{{route('forget_r')}}" style=" margin: 5px;" method="POST">
        @csrf
        @if(session('sucess'))
       <div> {{ session('sucess')}}</div>
        @endif
        <input type="email" name="email" placeholder="Enter your Email">
        <input type="submit">
     </form>

   </div>
</body>
</html>