@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h2>Signup</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <form class="form-vertical" role="form" method="post" action="{{ route('auth.signup') }}">
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label class="control-label" for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" placeholder="Username" required>
                    @if ($errors->has('username'))
                    <span class="help-block">
                        {{ $errors->first('username') }}
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-default">Sign Up</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@stop
