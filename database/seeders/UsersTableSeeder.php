<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'Administrador')->first();
        $admin = User::firstOrCreate([
            "name"  =>  "Administrador",
            "email" =>  "admin@admin.com.br",
            "password"  =>  bcrypt("Mudar123@"),
        ]);

        $admin->roles()->attach($adminRole);
    }
}
