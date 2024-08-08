<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
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
}
