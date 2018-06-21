@extends ('layouts.master')

@section('content')
    @if(Auth::check())
        <div class="welcome-banner">
            Welcome, {{ Auth::user()->name }}. Here's your next binge.
        </div>
    @endif
    @for($i = 1; $i<3; $i++)
        <div class="month">
            <div class="month-header">
                {{ date("M") }} 2018
            </div>
            @for($j = 1; $j<3+$i; $j++)
                <div class="day">
                    <div class="day-header">
                        {{date("M") . ' ' . $j }}
                    </div>
                    <div class="day-posters">
                        {{-- posters row --}}
                        <div class="block-container">
                            @for($k = 1; $k<6; $k++)
                                <div class="block card-box">
                                    <div class="card">
                                        <div class="card-poster">
                                            <img src="{{ url('/') . '/posters/poster0' . $k . '.jpg' }}">
                                        </div>
                                        <div class="card-footer">
                                            <a href="#" class="button-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    @endfor
    <div class="section-title">Upcoming Movie Releases</div>
    <div class="block-container">
        @for($i = 1; $i<6; $i++)
            <div class="block card-box">
                <div class="card">
                    <div class="card-poster">
                        <img src="{{ url('/') . '/posters/poster0' . $i . '.jpg' }}">
                    </div>
                    <div class="card-footer">
                        <a href="#" class="button-primary">Add</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>

@endsection
