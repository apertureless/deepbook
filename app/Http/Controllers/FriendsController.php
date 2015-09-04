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

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();

        if (! $user) {
            return redirect()
                ->route('home')
                ->with('info', 'User could not be found.');
        }

        // @todo Add one method to user modell to shorten this up. After writing the tests.

        if (Auth::user()->id === $user->id) {
             return redirect()
                ->route('home')
                ->with('info', 'You cannot add yourself. You doughnut.');
         }

        if (Auth::user()->hasFriendRequestPending($user) ||
            $user->hasFriendRequestPending(Auth::user())) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'Friend request already pending');
        }

        if (Auth::user()->isFriendsWith($user)) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'You are already friends');
        }

        Auth::user()->addFriend($user);
        return redirect()
            ->route('profile.index', ['username' => $user->username])
            ->with('info', 'Friend request send');
    }

    public function getAccept( $username )
    {
        $user = User::where('username', $username)->first();
        // @todo refactor this redudant code into a method to check user.
        if (! $user) {
            return redirect()
                ->route('home')
                ->with('info', 'User could not be found.');
        }

        if (! Auth::user()->hasReceivedFriendRequest($user)) {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriend($user);
        return redirect()
            ->route('profile.index', ['username' => $user->username])
            ->with('info', 'Friend request accepted');
    }
}
