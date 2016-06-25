@extends('templates.default')

@section('content')
    <h1>Sign up</h1>
    <form class="navbar-form navbar-left" method="post" role="search" action="{{ route('auth.signup') }}">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="text" class="form-control" placeholder="Email" name="email">
            @if($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <br/><br/>
        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
            <input type="text" class="form-control" placeholder="Username" name="username">
            @if($errors->has('username'))
                <span class="help-block">{{ $errors->first('username') }}</span>
            @endif
        </div>
        <br/><br/>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="text" class="form-control" placeholder="Password" name="password">
            @if($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <br/><br/>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="First name" name="first_name">
        </div>
        <br/><br/>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Last name" name="last_name">
        </div>
        <br/><br/>
        <button type="submit" class="btn btn-default">Sign up</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
@stop