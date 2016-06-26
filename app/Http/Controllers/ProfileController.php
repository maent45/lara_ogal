<?php

namespace Lago\Http\Controllers;

use Lago\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // render edit profile form
    public function getEdit() {
        return view('profile.edit');
    }

    public function postEdit(Request $request) {
        // validate
        $this->validate($request, [
            'first_name' => 'alpha|max:50',
            'last_name' => 'alpha|max:50',
        ]);

        // access the currently authenticated user
        // then update table columns
        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        // once update, redirect back with notification
        return redirect()->route('profile.edit')
            ->with('info', 'Your profile is now updated');
    }

}