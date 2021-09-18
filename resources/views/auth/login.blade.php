<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="loginsec">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            Email:<input type="email" name="email">
            Password:<input type="password" name="password"><br>
            <a href="{{route('forget')}}">Reset Password</a>
            <input type="submit" value="Login">
        </form>
    </div>
    
</body>
</html>