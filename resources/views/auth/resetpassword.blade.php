<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
          </div>
          <div class="form-group">
              <label for="exampleInputPassword1">Confirm Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password_confirmation">
            </div>
            <input type="submit" value="Submit">
    </form>
</body>
</html>