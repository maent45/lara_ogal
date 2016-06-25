<?php

namespace Lago\Http\Controllers;

use Auth;
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
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        // once record is created, redirect back to homepage with notification
        return redirect()->route('home')->with('info', 'Your account has been created, you can now sign in.'); // redirect and also set 'info' session
    }

    public function getSignin() {
        return view('auth.signin');
    }

    public function postSignin(Request $request) {
        // validate required fields
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        // once validated, now authenticate user.
        // if attempt if successful session is automatically set.
        // 'only' allows us to pass in amount of data as array, in this case it's only 'email' and 'password'.
        // we also check if the 'remember' check box has been checked.
        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->back()->with('info', 'Sorry, you cannot sign in with those credentials.'); // set session and notification message
        }

        // if authenticated then direct to home page with notification
        return redirect()->route('home')->with('info', 'You are now signed in!');

    }

    public function Signout() {
        Auth::logout();

        return redirect()->route('home')->with('info', 'You have signed out.');
    }

}