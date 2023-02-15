<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function company()
    {
        return view('company.pages.dashboard');
    }
}
