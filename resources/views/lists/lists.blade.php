@extends ('layouts.master')

@section('content')
    <div class="content-wrapper">
        @include('components.usernavbar', compact('user_id'))
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
                                <div class="thumbnail-poster" style="z-index: {{ $z }};">
                                    @if($poster)
                                        <img src="{{ $poster }}">
                                    @endif
                                </div>
                                @php $z = $z - 1; @endphp
                            @endforeach
                        </div>
                        <div class="list-details">
                            <div class="list-header">
                                <div class="billboard-title">
                                    <a href="{{ url('/user') . '/' . $user_id . '/lists/' . $list['id'] }}">{{ $list['name'] }}</a>
                                </div>
                                <div class="list-options">
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                    <a href="#"><i class="fa fa-trash-o"></i></a>
                                </div>
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
