{{-- Search Bar Component --}}

<div class="topnav">
    {{--<a href="#"><i class="fa fa-tv"></i></a>--}}
    <a href="{{ url('/') . '/tv' }}">On The Air</a>
    <a href="{{ url('/') . '/tv/airing-today' }}">Airing Today</a>
    <a href="#">Popular</a>
    <a href="#">Top Rated</a>
    <input type="text" placeholder="Search TV...">
</div>

{{--
    <a href="#">Airing Today</a>
    <a href="#">On the Air</a>
    <a href="#">Popular</a>
    <a href="#">Top Rated</a>
    <a href="#">AIRING TODAY</a>
    <a href="#">ON THE AIR</a>
    <a href="#">POPULAR</a>
    <a href="#">TOP RATED</a>
--}}
