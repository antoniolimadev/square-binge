{{-- User Navigation Bar Component --}}

<div class="topnav">
    <a href="{{ url('/user') . '/' . $user_id }}"><i class="fa fa-user"></i> {{ $userName }} </a>
    <a href="{{ url('/user') . '/' . $user_id . '/lists' }}">Lists</a>
</div>
