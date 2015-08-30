<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="{{ route('home') }}" class="navbar-brand">Deepbook</a>
        </div>
         @if (Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="">Timeline</a></li>
                <li><a href="">Friends</a></li>
            </ul>
            <form action="" role="search" class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Find your friends">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
         @endif
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li><a href="">{{ Auth::user()->getUsername() }}</a></li>
                <li><a href="">Update Profile</a></li>
                <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
            @else
                <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
            @endif
        </ul>
    </div>
</div>
