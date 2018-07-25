@extends ('layouts.master')

@section('content')
    <div class="content-wrapper">
    @if(Auth::check())
    <div class="welcome-banner">
        Welcome, {{ Auth::user()->name }}. Here's your next binge.
    </div>
    @else
    <div class="billboard-banner">
        <div class="billboard-row">
            <div class="billboard-title">
                <a href="{{ url('/tv') }}">This week on TV</a>
            </div>
            <div class="block-container">
                @foreach($showArray as $show)
                    <a href="{{ url('/') . '/show/' . $show->id }}">
                        <div class="billboard-single-container">
                            <img src="{{ $show->bannerPath }}">
                            <div class="billboard-img-title">{{ $show->name }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="billboard-row">
            <div class="billboard-title">
                <a href="{{ url('/movies') }}">Now in Theaters</a>
            </div>
            <div class="block-container">
                @foreach($movieArray as $movie)
                    <a href="{{ url('/') . '/tv/' . $movie->id }}">
                        <div class="billboard-single-container">
                            <img src="{{ $movie->bannerPath }}">
                            <div class="billboard-img-title">{{ $movie->name }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    </div>

@endsection
