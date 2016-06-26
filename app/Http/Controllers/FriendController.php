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

}