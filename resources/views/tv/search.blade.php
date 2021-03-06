@extends ('layouts.master')

@section('content')
    <div class="content-wrapper">
        {{-- SEARCHBOX --}}
        <form autoComplete="off" action="/square-binge/public/tv/search">
            <div class="search-box">
                @if($query)
                <input type="text" value="{{ request(['query'])['query'] }}" name="query" placeholder="Search TV..."/>
                @else
                <input type="text" name="query" placeholder="Search TV..."/>
                @endif
                {{--<span>Sort by</span>--}}
                <div class="dropdown">
                    <button class="dropdown-btn" type="button">Sort by
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Next Episode</a>
                        <a href="#">First Release</a>
                        <a href="#">Name</a>
                        <a href="#">Popularity</a>
                    </div>
                </div>
            </div>
        </form>
        <div id="reactSearchWrapper"></div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".header-links").find(".active").removeClass("active");
            $(".header-links a:contains('TV')").addClass('active');
        });
    </script>
@endsection
