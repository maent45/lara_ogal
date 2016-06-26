@extends('templates.default')

@section('content')
    <div class="row">
        <!--- user info --->
        <div class="col-lg-6">
            @include('user.partials.userblock')
            <hr>
        </div>
        <h3>{{ $user->getFirstNameOrUsername() }}'s friends.</h3>
        <!--- output user's friends --->
        @if(!$user->friends()->count())
            <p>{{ $user->getFirstNameOrUsername() }} has no friends, yet.</p>
        @else
            @foreach($user->friends() as $user)
                @include('user/partials/userblock')
            @endforeach
        @endif
    </div>
@stop