@extends('templates.default')

@section('content')
    <h3>Update your profile</h3>
    <form class="navbar-form navbar-left" role="form" method="post" action="{{ route('profile.edit') }}">
        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
            <input type="text" class="form-control" name="first_name" placeholder="First name" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">
            @if($errors->has('first_name'))
                <span class="help-block">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <br><br>
        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
            <input type="text" class="form-control" name="last_name" placeholder="Last name" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">
            @if($errors->has('last_name'))
                <span class="help-block">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <br><br>
        <button type="submit" class="btn btn-default">Update</button>
    </form>
@stop