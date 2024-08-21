<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    //Executar o construct quando instanciar a classe - verifica permissão de quem esta logado
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-role-permission', ['only' => ['index']]);
        $this->middleware('permission:update-role-permission', ['only' => ['update']]);
    }

    //Listar as permissões do papel
    public function index(Role $role)
    {
        //Verificar se o papel é Super Admin, não permitir visualizar as pemissões
        if ($role->name == 'Super Admin') {
            return redirect()->route('role.index')->with('error', 'Permissão de Super Admin não pode ser acessada!');
        }

        //Recuperar as permissões
        $rolePermissions = DB::table('role_has_permissions')->where('role_id', $role->id)
            ->pluck('permission_id')->all();

        //Recuperar permissões do papel
        $permissions = Permission::get();

        //Carregar a view
        return view('rolesPermission.index', [
            'menu' => 'roles',
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions,
            'role' => $role
        ]);
    }

    //Atualizar a permissão de acesso do papel
    public function update(Request $request, Role $role)
    {
        //Obter a permissão especifica com base no ID fornecido em $request->permission
        $permission = Permission::find($request->permission);

        if(!$permission){
            return redirect()->route('role-permission.index', ['role' => $role->id])->with('error', 'Permissão não encontrada!');
        }

        //Verificar se a permissão está esta associada ao papel
        if($role->permissions->contains($permission)){
            //Bloquear permissão do papel
            $role->revokePermissionTo($permission);
            return redirect()->route('role-permission.index', ['role' => $role])->with('success', 'Permissão bloqueada para este papel!');
        }else{
            //Liberar permissão para o papel
            $role->givePermissionTo($permission);
            return redirect()->route('role-permission.index', ['role' => $role])->with('success', 'Permissão liberada para este papel!');
        };
    }
}
