@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Your friends</h3>
            @if(! $friends->count())
                <p>You have no friends, yo.</p>
            @else
                @foreach ($friends as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
        <div class="col-md-6">
            <h3>Friend requests</h3>

            @if(! $requests->count())
                <p>You have no friend requests.</p>
            @else
                @foreach ($requests as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif

        </div>
    </div>
@stop
