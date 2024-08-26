<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'William Henrique',
            'email' => 'will-hc-1984@hotmail.com',
            'password' => Hash::make('123456', ['rounds' => 10])
        ]);

        //Atribui papel para o usuario
        $superAdmin->assignRole('Super Admin');

        $superAdmin2 = User::create([
            'name' => 'Karen Daiane Martins Gonçalves',
            'email' => 'karen-daiane@hotmail.com',
            'password' => Hash::make('123456', ['rounds' => 10])
        ]);

        // //Atribui papel para o usuario
        $superAdmin2->assignRole('Super Admin');

        $consultor = User::create([
            'name' => 'Evelin Eufrásio',
            'email' => 'evelin@hotmail.com',
            'password' => Hash::make('123456', ['rounds' => 10])
        ]);

        //Atribui papel para o usuario
        $consultor->assignRole('Consultor');

        // $admin = User::create([
        //     'name' => 'José Eufrásio',
        //     'email' => 'admin@admin',
        //     'password' => Hash::make('123456', ['rounds' => 10])
        // ]);

        // //Atribui papel para o usuario
        // $admin->assignRole('Admin');
    }
}
