@extends ('layouts.master')

@section('content')
    @if(Auth::check())
        <div class="welcome-banner">
            Welcome, {{ Auth::user()->name }}. Here's your next binge.
        </div>
    @endif

    {{-- SEARCH BAR --}}
    @component('components.searchbar')
    @endcomponent
    {{-- END OF SEARCH BAR --}}
    @for($i = 0; $i<1; $i++)
        <div class="month">
            <div class="month-header">
                {{ date("M") }} 2018
            </div>
            @for($j = 1; $j<4+$i; $j++)
                <div class="day">
                    <div class="day-header">
                        {{date("M") . ' ' . $j }}
                    </div>
                    <div class="day-schedule">
                        @foreach($dataArray as $show)
                        @component('components.tvshow')
                            @slot('cover')
                                {{--https://image.tmdb.org/t/p/w200/1ryCwZaZFAlG0c1w8XiMHeAxxYy.jpg--}}
                                {{ $show->posterPath }}
                            @endslot
                            @slot('title') {{ $show->name }} @endslot
                            @slot('year') {{ $show->firstAirDate }} @endslot
                            @slot('overview')
                                    {{--Set in a dystopian future, a woman is forced to live as a concubine under a fundamentalist theocratic dictatorship. A TV adaptation of Margaret Atwood's novel.--}}
                                {{ $show->overview }}
                            @endslot
                            @slot('otherInfo') [more info] @endslot
                        @endcomponent
                        @endforeach
                    </div>
                </div>
            @endfor
        </div>
    @endfor
    {{--<div class="section-title">Upcoming Movie Releases</div>--}}
    {{--<div class="block-container">--}}
        {{--@for($i = 1; $i<6; $i++)--}}
            {{--<div class="block card-box">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-poster">--}}
                        {{--<img src="{{ url('/') . '/posters/poster0' . $i . '.jpg' }}">--}}
                    {{--</div>--}}
                    {{--<div class="card-footer">--}}
                        {{--<a href="#" class="button-primary">Add</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endfor--}}
    {{--</div>--}}

@endsection
