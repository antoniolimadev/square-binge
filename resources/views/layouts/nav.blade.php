<div class="header">
    <a href="{{ url('/') }}" class="logo">SquareBinge.</a>
    <span class="header-subtitle">Never miss a release again.</span>
    <div class="header-links">
        @if(Auth::check())
            <a href="{{ url('/home') }}">My Account</a>
        @else
            <a href="#" onclick="openLogin()"><i class="fa fa-sign-in"></i> Login </a>
            <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register </a>
        @endif
        <a href="{{ url('/') }}/tv"><i class="fa fa-tv"></i> TV </a>
        <a href="{{ url('/') }}/movies"><i class="fa fa-film"></i> Movies </a>
    </div>
    <form method="post" action="#" id="login" class="login-form">
        <a href="#" onclick="closeLogin()" class="close-login-button">&times;</a>
        <div class="login-form-item">
            <label for="username">Username or Email</label>
            <input type="email" name="username" id="username" autocomplete="email" value="">
            <div class="login-checkbox">
                <input type="checkbox" name="remember" value="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Remember me</label>
            </div>
        </div>
        <div class="login-form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="current-password" value="">
            <div class="login-forgot">
                <a href="#">Forgot my password</a>
            </div>
        </div>
        <div class="login-form-item">
            <button type="submit" class="login-button"> Login </button>
        </div>
    </form>
</div>
<hr class="header-hr">
