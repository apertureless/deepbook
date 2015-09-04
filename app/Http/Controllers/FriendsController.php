<?php

namespace Deepbook\Http\Controllers;

use Auth;
use Deepbook\Models\User;
use Illuminate\Http\Request;

/**
* Friends Controller
*/
class FriendsController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index')
                ->with('friends', $friends)
                ->with('requests', $requests);
    }
}
