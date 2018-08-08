@extends ('layouts.user')

@section('user-content')

    <div class="list-box">
        <div class="user-section">
            <div class="user-section-title"> All Lists </div>
            <a href="#" class="new-list-button"> New List </a>
        </div>
        @foreach($userLists as $list)
            <div class="list-wrapper">
                <hr class="list-hr">
                <div class="list-content">
                    <div class="thumbnail-stack">
                        @php $z = 5; @endphp
                        @foreach($list->thumbnails as $poster)
                            <div class="overlapped" style="z-index: {{ $z }};">
                                @if($poster)
                                    <img src="{{ $poster }}">
                                @else
                                    <div class="blank-overlapped"></div>
                                @endif
                            </div>
                            @php $z = $z - 1; @endphp
                        @endforeach
                    </div>
                    <div class="list-details">
                        <div class="billboard-title">
                            <a href="{{ url()->current() . '/' . $list['id'] }}">{{ $list['name'] }}</a>
                        </div>
                        <div class="list-mid">
                            <div>{{ $list->total }} items</div>
                            @if($list->private)
                                <div class="list-badge">PRIVATE</div>
                            @else
                                <div class="list-badge">PUBLIC</div>
                            @endif
                        </div>
                        <div class="list-description">
                            {{ $list->description }}
                        </div>
                    </div>
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
