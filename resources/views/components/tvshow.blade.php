{{-- TV Show Component --}}

<div class="tvshow-wrap">
    <div class="tvshow-date-2">{{ $airDate or 'TBA' }}</div>
    <div class="tvshow-card">
        <div class="block-container">
            {{--<div class="tvshow-date">--}}
            {{--<div class="tvshow-date-day">Jun</div>--}}
            {{--<div class="tvshow-date-month">15</div>--}}
            {{--</div>--}}
            <div class="tvshow-cover">
                <img src="{{ $cover }}">
            </div>
            <div class="tvshow-info">
                <div class="tvshow-title">
                    {{ $title or 'Default Title' }}
                    <span>({{ \Carbon\Carbon::parse($year)->year }})</span>
                </div>
                @if(strlen($overview) > 2350)
                    <div class="tvshow-overview"> {{ $overview }} </div>
                @else
                    <div class="tvshow-overview"> {{ $overview }} </div>
                @endif
                <div class="tvshow-other"> {{ $otherInfo }} </div>
            </div>
            <a href="#" class="button-follow">Follow</a>
        </div>
    </div>
</div>
