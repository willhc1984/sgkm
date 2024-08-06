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
            'index-user',
            'show-user',
            'create-user',
            'edit-user',
            'destroy-user',

            'index-produtos',
            'show-produtos',
            'create-produtos',
            'edit-produtos',
            'destroy-produtos',

            'index-consultores',
            'show-consultores',
            'create-consultores',
            'edit-consultores',
            'destroy-consultores',

            'index-role',
            'show-role',
            'create-role',
            'edit-role',
            'destroy-role',
            'index-role-permission',
            'update-role-permission'
        ];

        foreach ($permissions as $permission) {
            $existingPermission = Permission::where('name', $permission)->first();
            if (!$existingPermission) {
                Permission::create(['name' => $permission, 'guard_name' => 'web']);
            }
        }
    }
}
