<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //Executar o construct quando instanciar a classe - verifica permissão de quem esta logado
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permission:index-role', ['only' => ['index']]);
        $this->middleware('permission:create-role', ['only' => ['create']]);
        $this->middleware('permission:store-role', ['only' => ['store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit']]);
        $this->middleware('permission:destroy-role', ['only' => ['destroy']]);
        $this->middleware('permission:index-permission', ['only' => ['index']]);
    }
    
    //Listar papéis
    public function index(){
        $roles = Role::orderByDesc('name')->paginate(40);
        return view('roles.index', [
            'menu' => 'papeis',
            'roles' => $roles
        ]);
    }
}
