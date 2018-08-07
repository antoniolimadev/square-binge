<div class="header">
    <a href="{{ url('/') }}" class="logo">SquareBinge.</a>
    <span class="header-subtitle">Never miss a release again.</span>
    <div class="header-links">
    @if(Auth::check())
        <a id="user_id" href="{{ url('/user') . '/' . Auth::user()->id }}"><i class="fa fa-home"></i> {{ Auth::user()->name }} </a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="invisible">
            @csrf
        </form>
    @else
        <a href="#log-in" onclick="openLogin()"><i class="fa fa-sign-in"></i> Login </a>
        <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register </a>
    @endif
        <a href="{{ url('/') }}/tv"><i class="fa fa-tv"></i> TV </a>
        <a href="{{ url('/') }}/movies"><i class="fa fa-film"></i> Movies </a>
    </div>
    @if(!Auth::check())
    <form method="POST" action="{{ route('login') }}" id="login" class="login-form">
        @csrf
        <a href="#" onclick="closeLogin()" class="close-login-button">&times;</a>
        <div class="login-form-item">
            <label for="email">Username or Email</label>
            {{--<input id="email" type="email" name="username" autocomplete="email" autofocus>--}}
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            <div class="login-checkbox">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>
        </div>
        <div class="login-form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="current-password" required>
            <div class="login-forgot">
                <a href="{{ route('password.request') }}">Forgot my password</a>
            </div>
        </div>
        <div class="login-form-item">
            <button type="submit" class="login-button"> Login </button>
        </div>
    </form>
    @endif
</div>
<hr class="header-hr">
