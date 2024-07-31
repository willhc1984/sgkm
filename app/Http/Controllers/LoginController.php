<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        //Validar usuario e senha com informações do banco de dados
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        //Verificar se o usuario foi autenticado
        if (!$authenticated) {
            //Redireciona com msg de erro
            return back()->withInput()->with('error', 'Credenciais inválidas!');
        }

        //Rediciona o usuario para dentro so sistema
        return redirect()->route('dashboard.index');
    }
}
