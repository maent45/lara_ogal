@extends('templates.default')

@section('content')
    <h1>Sign in</h1>
    <form class="navbar-form navbar-left" method="post" role="search" action="{{ route('auth.signin') }}">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="text" class="form-control" placeholder="Email" name="email">
            @if($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <br/><br/>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <input type="password" class="form-control" placeholder="Password" name="password">
            @if($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <br/><br/>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
        </div>
        <br/><br/>
        <button type="submit" class="btn btn-default">Sign in</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
@stop