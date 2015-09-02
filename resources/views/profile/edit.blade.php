@extends("templates.default")

@section("content")
    <h3>Update Profile</h3>

    <div class="row">
        <div class="col-md-6">
            <form class="form-vertical" role="form" method="post" action="{{ route('profile.edit') }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') ?: Auth::user()->email }}" placeholder="Email">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-default">Update Profile</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>

@stop
