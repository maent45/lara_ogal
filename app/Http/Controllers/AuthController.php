<?php

namespace Lago\Http\Controllers;

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

        // test post
        dd('algud');
    }

}