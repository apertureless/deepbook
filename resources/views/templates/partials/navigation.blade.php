<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="{{ route('home') }}" class="navbar-brand">Deepbook</a>
        </div>
         @if (Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}">Timeline</a></li>
                <li><a href="{{ route('friends.index') }}">Friends</a></li>
            </ul>
            <form role="search" class="navbar-form navbar-left" action="{{ route('search.results') }}">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Find your friends">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
         @endif
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li>
                    <a href="{{ route('profile.index', ['username' => Auth::user()->username])}}">
                        {{ Auth::user()->getUsername() }}
                    </a>
                </li>
                <li><a href="{{ route('profile.edit') }}">Update Profile</a></li>
                <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
            @else
                <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
            @endif
        </ul>
    </div>
</div>
