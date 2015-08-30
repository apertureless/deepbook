<?php

namespace Deepbook\Http\Controllers;

use Deepbook\Models\User;
use Illuminate\Http\Request;

/**
 * Authentication Controller
 */
class SearchController extends Controller
{

    public function getResults(Request $request)
    {
        $query = $request->input('query');
        if(!$query) {
            return redirect()->route('home');
        }
        $users = User::where('username', 'LIKE', "%{$query}%" )->get();

        return view('search.results')->with('users', $users);
    }
}
