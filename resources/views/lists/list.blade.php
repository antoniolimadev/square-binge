@extends ('layouts.master')

@section('content')
    <div class="content-wrapper">
        @include('components.usernavbar', compact('user_id'))
        @if(!$hide)
            <div id="reactList"></div>
        @else
            <div>This list is not public.</div>
        @endif
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
