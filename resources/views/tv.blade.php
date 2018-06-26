@extends ('layouts.master')

@section('content')

    <div class="content-wrapper">
        @component('components.searchbar')
        @endcomponent
        <div class="card-wrapper">
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

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".header-links").find(".active").removeClass("active");
            $(".header-links a:contains('TV')").addClass('active');
        });
    </script>
@endsection
