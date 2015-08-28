<?php

namespace Deepbook\Http\Controllers;

class HomeController extends Controller {
    public function index()
    {
        return view('home');
    }
}
