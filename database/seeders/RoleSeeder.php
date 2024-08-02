<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Role::where('name', 'Super Admin')->first()) {
            Role::create(['name' => 'Super Admin']);
        }

        if (!Role::where('name', 'Consultor')->first()) {
            $consultor = Role::create(['name' => 'Consultor']);
            //Dar permissao para o papel
            $consultor->givePermissionTo([
                'index-produtos',
                'show-produtos',
                'edit-produtos',
                
                'index-consultores',
                'show-consultores',
            ]);
        }
    }
}
