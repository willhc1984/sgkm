<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Login
    public function index()
    {
        //Carrega a view
        return view('login.index');
    }

    public function loginProcess(LoginRequest $request)
    {
        //Validar dados do formulario
        $request->validated();

        dd("OK");

    }
}
