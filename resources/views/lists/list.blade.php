@extends ('layouts.user')

@section('user-content')

    <div id="reactList"></div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".topnav").find(".active").removeClass("active");
            $(".topnav a:contains('Lists')").addClass('active');
        });
    </script>
@endsection
