@extends ('layouts.user')

@section('user-content')

    <h1>List</h1>

    @foreach($listItems as $item)
        <a href="#">{{ $item['id'] }}: {{ $item['moviedb_id'] }}</a>
        <br>
    @endforeach

@endsection
