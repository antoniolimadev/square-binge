<!DOCTYPE html>
<html>
<head>
    <title>Square Binge</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ url('/') }}/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.nav')
    <hr>
    <div class="content">
        @yield('content')
    </div>
    <div style="margin-top: 1000px;">
        space
    </div>
    @include('layouts.footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @yield('scripts')
</body>
</html>
