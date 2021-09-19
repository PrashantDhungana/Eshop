<form action="{{ route('login') }}" method="POST">
    @csrf
    Email:<input type="email" name="email">
    Password:<input type="password" name="password">
    <input type="submit" value="Login">
    <a href="/login/github" class="btn btn-secondary btn-block">Login With Github</a>
</form>