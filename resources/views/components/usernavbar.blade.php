{{-- User Navigation Bar Component --}}

<div class="topnav">
    <a href="#"><i class="fa fa-user"></i> Username </a>
    <a href="#">Dashboard</a>
    <a href="#">Watchlist</a>
    <a href="{{ url('/user') . '/' . $user_id . '/lists' }}">Lists</a>
</div>
