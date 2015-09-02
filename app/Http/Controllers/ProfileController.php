<?php

namespace Deepbook\Http\Controllers;

use Auth;
use Deepbook\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile($username)
    {
        $user = User::where('username', $username)->first();
        if(!$user) {
            abort(404);
        }
        return view('profile.index')
            ->with('user', $user);
    }

    public function getEdit()
    {
        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, [
            'email' => 'unique:users|email|max:255',
            'password' => 'min:8',
        ]);

        Auth::user()->update([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('profile.edit')->with('info', 'Your Profile has been updated');
    }
}
