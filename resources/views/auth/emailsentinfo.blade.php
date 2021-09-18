<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Sent</title>
</head>
<body>
    An email has been sent to the email. Please verify it by checking your email. 
    <a href="{{route('product.index')}}" class="btn btn-warning">Return to home</a>
    <div class="bg-danger text-white">Didn't get the email? 
    <a href="{{route('resend.mail',$id)}}" class="btn btn-primary">Resend again</a></div>
</body>
</html>