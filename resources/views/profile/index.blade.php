@extends('templates.default')

@section('content')

    <div class="row">
        <div class="col-md-6">
            @include('user.partials.userblock')
            <hr>
        </div>

        <div class="col-md-4 col-md-offset-2">
            @if (Auth::user()->hasFriendRequestPending($user))
                <p>Waiting for {{ $user->username }}, to accept your request.</p>
            @elseif (Auth::user()->hasReceivedFriendRequest($user))
                <a href="{{ route('friends.accept', ['username' => $user->username])}}" class="btn btn-primary">Accept Friend Request</a>
            @elseif (Auth::user()->isFriendsWith($user))
                You and {{ $user->username }} are friends.
            @elseif (Auth::user()->id !== $user->id)
                <a href="{{ route('friends.add', ['username' => $user->username] ) }}" class="btn btn-primary">Add as friend</a>
            @endif
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
