<?php

namespace Lago\Http\Controllers;

use Lago\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller {

    public function getSignUp() {
        return view('auth.signup');
    }

    public function postSignUp(Request $request) {
        // validate required db fields on submit
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255', // 'fieldname' => 'required|unique to the 'users' table|has to be valid email|max of 255'
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
        ]);

        // after validation create user using the 'User' model
        User::create([
            'email' => $request->input('email'), // 'db field => 'input name'
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')), // encrypt password
        ]);

        // once record is created, redirect back to homepage with notification
        return redirect()->route('home')->with('info', 'Your account has been created, you can now sign in.'); // redirect and also set 'info' session
    }

}