<?php

namespace Lago\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Lago\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function getResults(Request $request) {

        $query = $request->input('query'); // 'query' name of input field in search form

        // check if query exists
        if (!$query) {
            return redirect()->route('home');
        }

        // else filter db results by LIKE clause
        $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->get();

        return view('search.results')->with('users', $users); // 'users' refers to table, '$users' is filtered result set
    }

}