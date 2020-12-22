<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //show home
    public function index()
    {
        return view('pages.dashboard');
    }
}
