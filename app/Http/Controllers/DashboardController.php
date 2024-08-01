<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Dashboard
    public function index(){
        return view('dashboard.index', ['menu' => 'dashboard']);
    }
}
