@extends('templates.default')

@section('content')

    <div class="row">
        <div class="col-md-6">
            @include('user.partials.userblock')
            <hr>
        </div>

        <div class="col-md-4 col-md-offset-2">
            <h4>{{ $user->username }}' friends</h4>
            <hr>
            @if(! $user->friends()->count())
                <p>You have no friends, yo.</p>
            @else
                @foreach ($user->friends() as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop
