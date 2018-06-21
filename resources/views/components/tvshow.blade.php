{{-- TV Show Component --}}

<div class="tvshow-card">
    <div class="block-container">
        <div class="tvshow-cover">
            <img src="{{ $cover }}">
        </div>
        <div class="tvshow-info">
            <div class="tvshow-title">
                {{ $title or 'Default Title' }} <span>({{ $year }})</span>
            </div>
            <div class="tvshow-overview"> {{ $overview }} </div>
            <div class="tvshow-other"> {{ $otherInfo }} </div>
            <a href="#" class="button-follow">Follow</a>
        </div>
    </div>
</div>
