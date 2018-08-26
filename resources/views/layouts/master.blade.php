<!DOCTYPE html>
<html>
<head>
    <title>Square Binge</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (auth()->check()) <meta name="api-token" content="{{ auth()->user()->api_token }}"> @endif
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ url('/') }}/fontawesome-free-5.2.0-web/css/all.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.nav')
    @if(count($errors))
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="content">
        @yield('content')
    </div>
    <div style="margin-top: 1000px;">
        space
    </div>
    @include('layouts.footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ url('/') }}/js/app.js" ></script>
    <script type="text/javascript">
        function openLogin() {
            $(".header-links").addClass('invisible');
            $(".login-form").css("display", "block");
        }
        function closeLogin() {
            $(".header-links").removeClass('invisible');
            $(".login-form").css("display", "none");
        }
    </script>
    @yield('scripts')
</body>
</html>
