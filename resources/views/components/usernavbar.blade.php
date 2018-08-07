{{-- User Navigation Bar Component --}}

<div class="topnav">
    <a href="#"><i class="fa fa-user"></i> adminer</a>
    <a href="#">Dashboard</a>
    <a href="#">Watchlist</a>
    <a href="{{ url()->current() . '/lists' }}">Lists</a>
</div>
