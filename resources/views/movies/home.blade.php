@extends ('layouts.master')

@section('content')
<div class="content-wrapper">
    <div id="reactMovieWrapper"></div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".header-links").find(".active").removeClass("active");
            $(".header-links a:contains('Movies')").addClass('active');
        });
    </script>
@endsection
