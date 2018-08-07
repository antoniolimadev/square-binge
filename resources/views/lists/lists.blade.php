@extends ('layouts.user')

@section('user-content')
    <div class="card-wrapper">
        @foreach($userLists as $list)
            <div class="list-content">
                <hr class="list-hr">
                <div class="billboard-title">
                    <a href="{{ url()->current() . '/' . $list['id'] }}">{{ $list['name'] }}</a>
                </div>
                <div class="block-container thumbnail-stack">
                    @php $z = 5; @endphp
                    @foreach($list->thumbnails as $poster)
                        <div class="overlapped" style="z-index: {{ $z }};">
                            <img src="{{ $poster }}">
                        </div>
                        @php $z = $z - 1; @endphp
                    @endforeach
                </div>
            </div>
            <br>
        @endforeach
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".topnav").find(".active").removeClass("active");
            $(".topnav a:contains('Lists')").addClass('active');
        });
    </script>
@endsection
