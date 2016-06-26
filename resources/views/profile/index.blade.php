@extends('templates.default')

@section('content')
    <div class="row">
        <!--- user info --->
        <div class="col-lg-6">
            @include('user.partials.userblock')
            <hr>
        </div>

        @if (Auth::user()->hasFriendRequestPending($user))
            <p>Waiting for {{ $user->getFirstNameOrUsername() }} to accept your request.</p>
        @elseif (Auth::user()->hasFriendRequestReceived($user))
            <a href="#" class="btn btn-primary">Accept friend request</a>
        @elseif (Auth::user()->isFriendsWith($user))
            <p>You and {{ $user->getFirstNameOrUsername() }} are friends.</p>
        @else
            <a href="{{ route('friend.add', ['username' => $user->username]) }}" class="btn btn-primary">Add as friend</a>
        @endif

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