@extends ('layouts.master')

@section('content')
Movies

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".header-links").find(".active").removeClass("active");
            $(".header-links a:contains('Movies')").addClass('active');
        });
    </script>
@endsection
