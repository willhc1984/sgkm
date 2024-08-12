<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['title' => 'Listar usuários', 'name' => 'index-user'],
            ['title' => 'Exibir usuários', 'name' => 'show-user'],
            ['title' => 'Cadastrar usuários', 'name' => 'create-user'],
            ['title' => 'Editar usuários', 'name' => 'edit-user'],
            ['title' => 'Apagar usuários', 'name' => 'destroy-user'],

            ['title' => 'Listar produtos', 'name' => 'index-produtos'],
            ['title' => 'Exibir produtos', 'name' => 'show-produtos'],
            ['title' => 'Cadastrar produtos', 'name' => 'create-produtos'],
            ['title' => 'Editar produtos', 'name' => 'edit-produtos'],
            ['title' => 'Apagar produtos', 'name' => 'destroy-produtos'],

            ['title' => 'Listar consultores', 'name' => 'index-consultores'],
            ['title' => 'Exibir consultores', 'name' => 'show-consultores'],
            ['title' => 'Cadastrar consultores', 'name' => 'create-consultores'],
            ['title' => 'Editar consultores', 'name' => 'edit-consultores'],
            ['title' => 'Apagar consultores', 'name' => 'destroy-consultores'],

            ['title' => 'Listar papéis', 'name' => 'index-role'],
            ['title' => 'Exibir papéis', 'name' => 'show-role'],
            ['title' => 'Cadastrar papéis', 'name' => 'create-role'],
            ['title' => 'Editar papéis', 'name' => 'edit-role'],
            ['title' => 'Apagar papéis', 'name' => 'destroy-role'],

            ['title' => 'Listar permissões', 'name' => 'index-permission'],
            ['title' => 'Exibir permissões', 'name' => 'show-permission'],
            ['title' => 'Cadastrar permissões', 'name' => 'create-permission'],
            ['title' => 'Editar permissões', 'name' => 'edit-permission'],
            ['title' => 'Apagar permissões', 'name' => 'destroy-permission'],

            ['title' => 'Listar permissões do papel', 'name' => 'index-role-permission'],
            ['title' => 'Atualizar permissões do papel', 'name' => 'update-role-permission']
        ];

        foreach ($permissions as $permission) {
            $existingPermission = Permission::where('name', $permission['name'])->first();

            if (!$existingPermission) {
                Permission::create(['title' => $permission['title'], 'name' => $permission['name'], 'guard_name' => 'web']);
            }
        }
    }
}
