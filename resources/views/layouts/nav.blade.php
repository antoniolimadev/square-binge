<div class="header">
    <a href="{{ url('/') }}" class="logo">SquareBinge.</a>
    <span class="header-subtitle">Never miss a release again.</span>
    <div class="header-links">
        @if(Auth::check())
            <a href="{{ url('/home') }}">My Account</a>
        @else
            <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login </a>
            <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register </a>
        @endif
        <a href="{{ url('/') }}/tv"><i class="fa fa-tv"></i> TV </a>
        <a href="{{ url('/') }}/movies"><i class="fa fa-film"></i> Movies </a>
    </div>
</div>
