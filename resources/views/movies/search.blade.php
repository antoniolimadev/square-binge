@extends ('layouts.master')

@section('content')
    <div class="content-wrapper">
        {{-- SEARCHBOX --}}
        <form autoComplete="off" action="/square-binge/public/movies/search">
            <div class="search-box">
                @if($searchResults)
                <input type="text" value="{{ request(['query'])['query'] }}" name="query" placeholder="Search Movies..."/>
                @else
                <input type="text" name="query" placeholder="Search Movies..."/>
                @endif
                {{--<span>Sort by</span>--}}
                <div class="dropdown">
                    <button class="dropdown-btn" type="button">Sort by
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Release Date</a>
                        <a href="#">Name</a>
                        <a href="#">Popularity</a>
                    </div>
                </div>
            </div>
        </form>
        {{--<option>Next Episode</option>--}}
        {{--<option>First Release</option>--}}
        {{--<option>Name</option>--}}
        @if($searchResults)
        <div class="card-wrapper">
            @foreach($searchResults as $movie)
                @component('components.tvshow')
                    @slot('airDate')
                        {{  Carbon\Carbon::parse($movie->releaseDate)->year }}
                    @endslot
                    @slot('cover') {{ $movie->posterPath }} @endslot
                    @slot('title') {{ $movie->name }} @endslot
                    @slot('year') {{ $movie->releaseDate }} @endslot
                    @slot('overview') {{ str_limit($movie->overview, 260) }} @endslot
                    @slot('otherInfo') [more info] @endslot
                @endcomponent
            @endforeach
        </div>
        @endif
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".header-links").find(".active").removeClass("active");
            $(".header-links a:contains('Movies')").addClass('active');
        });
    </script>
@endsection
