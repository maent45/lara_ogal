<?php

namespace Lago\Http\Controllers;

class HomeController extends Controller {

    public function index() {
        return view('home');
    }

}