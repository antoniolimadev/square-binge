@extends ('layouts.master')

@section('content')

    <div class="content-wrapper">
        @component('components.searchbar')
        @endcomponent
        <div class="card-wrapper">
            @foreach($showsDataArray as $show)
                @component('components.tvshow')
                    @slot('airDate')
                        {{  $show->readableAirDate }}
                    @endslot
                    @slot('cover') {{ $show->posterPath }} @endslot
                    @slot('title') {{ $show->name }} @endslot
                    @slot('year') {{ $show->firstAirDate }} @endslot
                    @slot('overview') {{ $show->overview }} @endslot
                    @slot('otherInfo') [more info] @endslot
                @endcomponent
            @endforeach
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".header-links").find(".active").removeClass("active");
            $(".header-links a:contains('TV')").addClass('active');

            $(".topnav").find(".active").removeClass("active");
            $(".topnav a:contains({{ $headerLink }})").addClass('active')
        });
    </script>
@endsection
