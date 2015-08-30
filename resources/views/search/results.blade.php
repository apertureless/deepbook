@extends('templates.default')

@section('content')
    <h2>Results for {{ Request::input('query') }}:</h2>
    <hr>
    @if(!$users->count())
        <p>No results found. Sorry!</p>
    @else
        <div class="row">
            <div class="col-md-12">
                @foreach ($users as $user)
                    @include('user.partials.userblock')
                @endforeach
            </div>
        </div>
    @endif
@stop
