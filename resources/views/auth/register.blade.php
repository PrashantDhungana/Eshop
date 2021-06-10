<form action="{{ route('register') }}" method="POST">
    @csrf
    Name: <input type="text" name="name">
    Email:<input type="email" name="email">
    Password:<input type="password" name="password">
    Confirm Password:<input type="password" name="password_confirmation">
    <input type="submit" value="Register">
</form>