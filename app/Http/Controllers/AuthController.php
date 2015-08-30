<?php

namespace Deepbook\Http\Controllers;

use Auth;
use Deepbook\Models\User;
use Illuminate\Http\Request;

/**
 * Authentication Controller
 */
class AuthController extends Controller
{

    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users|alpha_dash|max:20',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:8',
        ]);

        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()
            ->route('home')
            ->with('info', 'Your Account has been created and you can login now.');
    }

     public function getSignin()
    {
        return view('auth.signin');
    }

     public function postSignin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only(['username', 'password']), $request->has('remember'))) {
            return redirect()->back()->with('info', 'User / Passwort wrong');
        }

        return redirect()->route('home')->with('info', 'You are now Signed in');
    }

    public function getSignout()
    {
        Auth::logout();
        return redirect()->route('home')->with('info', 'Successfully singed out');
    }
}
