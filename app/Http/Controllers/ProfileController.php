<?php

namespace Lago\Http\Controllers;

use Lago\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller {

    // pass 'username' as parameter
    public function getProfile($username) {

        // get the user
        $user = User::where('username', $username)->first(); // compare to the $user that's passed

        // now check if the user exists
        if (!$user) {
            // if so
            abort(404);
        }

        return view('profile.index')
            ->with('user', $user);
    }

}