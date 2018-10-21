@extends ('layouts.master')

@section('content')
    <div class="content-wrapper">
        @include('components.usernavbar', compact('user_id', 'userName'))
        <h1>User {{ $user_id }} Dashboard</h1>
    </div>
@endsection
