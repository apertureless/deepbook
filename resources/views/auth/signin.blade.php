@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">
          <h2>Login</h2>
            <form class="form-vertical" role="form" method="post" action="{{ route('auth.signin') }}">
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" placeholder="Username" required>
                    @if ($errors->has('username'))
                    <span class="help-block">
                        {{ $errors->first('username') }}
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"placeholder="Password" required>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                    @endif
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Login</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@stop
