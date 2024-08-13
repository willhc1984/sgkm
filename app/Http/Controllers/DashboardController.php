<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Executar o construct com middleware de autenticação e permissão
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-dashboard', ['only' => ['index']]);
    }

    //Dashboard
    public function index()
    {
        return view('dashboard.index', ['menu' => 'dashboard']);
    }

}
