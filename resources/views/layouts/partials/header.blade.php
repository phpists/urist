Header
@guest
    IS GUEST
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register.page') }}">Register</a>
@endguest
@auth
    IS AUTH
    <a href="{{ route('logout') }}" type="submit">Logout</a>
    <a href="{{ route('dashboard') }}">dashboard</a>
@endauth
<hr>
