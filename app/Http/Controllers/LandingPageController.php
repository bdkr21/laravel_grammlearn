<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        return view('landing');
    }

    public function index2()
    {
        return view('about');
    }
}
