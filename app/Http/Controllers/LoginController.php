<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

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
        //Obter o usuario autenticado
        $user = Auth::user();
        $user = User::find($user->id);

        //Verificar se as pemissões é Super Admin, tem acesso total
        if($user->hasRole('Super Admin')){
            //Usuario tem todas as permissões
            $permissions = Permission::pluck('name')->toArray();
        }else{
            //Recupera permissões do papel
            $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();
        }

        //dd($user->permissions);

        //Atribui as permissões ao usuario
        $user->syncPermissions($permissions);        

        //Rediciona o usuario para dentro so sistema
        return redirect()->route('dashboard.index');
    }

    //Logout de usuario
    public function destroy()
    {
        Auth::logout();
        //Redireciona ussuaior com msg de sucesso
        return redirect()->route('login.index')->with('success', 'Você saiu do sistema!');
    }
}
