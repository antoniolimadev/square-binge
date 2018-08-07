@extends ('layouts.master')

@section('content')
    <div class="content-wrapper">
        @include('components.usernavbar')
        @yield('user-content')
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".header-links").find(".active").removeClass("active");
            $("#user_id").addClass('active');
        });
    </script>
@endsection
