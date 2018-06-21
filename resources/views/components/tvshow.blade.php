{{-- TV Show Component --}}

<div class="tvshow-card">
    <div class="block-container">
        <div class="tvshow-cover">
            <img src="{{ $cover }}">
        </div>
        <div class="tvshow-info">
            <div class="tvshow-title">
                {{ $title or 'Default Title' }}
                <span>({{ \Carbon\Carbon::parse($year)->year }})</span>
            </div>
            @if(strlen($overview) > 235)
                <div class="tvshow-overview"> {{ str_limit($overview,235) }} </div>
            @else
                <div class="tvshow-overview"> {{ $overview }} </div>
            @endif
            <div class="tvshow-other"> {{ $otherInfo }} </div>
        </div>
        <a href="#" class="button-follow">Follow</a>
    </div>
</div>
