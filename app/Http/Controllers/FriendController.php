<?php

namespace Lago\Http\Controllers;

use Lago\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller {

    public function getIndex() {

        // get friends
        // 'friends()' and 'friendRequests()' defined in User model
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index')
            ->with('friends', $friends) // pass $friends to the view
            ->with('requests', $requests);
    }

    public function getAdd($username) {

        // get the user that's been requested in the url
        $user = User::where('username', $username)->first();

        // now check if that user exists
        if (!$user) {
            return redirect()
                ->route('home')
                ->with('info', 'That user could not be found');
        }

        // check bothways if user already has request pending or if other user already has request pending for us
        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'Friend request already pending.');
        }

        // now check if we're already friends
        if (Auth::user()->isFriendsWith($user)) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'You are already friends.');
        }

        // if all checks pass then finally add friend
        Auth::user()->addFriend($user);

        return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', 'Friend request sent.');

    }

}