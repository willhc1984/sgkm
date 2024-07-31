<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Listar usuários
    public function index()
    {
        //Recuperar registros do banco de dados
        $users = User::orderByDesc('created_at')->paginate(10);
        //Carrega view
        return view('users.index', [
            'menu' => 'usuarios',
            'users' => $users
        ]);
    }
}
