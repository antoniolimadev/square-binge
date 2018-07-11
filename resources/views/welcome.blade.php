@extends ('layouts.master')

@section('content')
    @if(Auth::check())
        <div class="welcome-banner">
            Welcome, {{ Auth::user()->name }}. Here's your next binge.
        </div>
    @endif

    {{-- SEARCH BAR --}}
    @component('components.searchbar')
    @endcomponent
    {{-- END OF SEARCH BAR --}}


@endsection
