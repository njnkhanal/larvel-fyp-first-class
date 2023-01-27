<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function homepage()
    {
        return view('welcome');
    }

    public function aboutpage()
    {
        return view('about');
    }

    public function contactpage()
    {
        return view('contact');
    }
    public function categorypage($name)
    {
        return view('category', compact('name'));
    }
    public function profilepage()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
