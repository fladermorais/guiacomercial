<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            "name"  =>  "Administrador",
            "description"   =>  "Acesso total ao sistema!",
        ]);

        Role::firstOrCreate([
            "name"  =>  "Profissional",
            "description"   =>  "Acesso Personalizado ao sistema!",
        ]);
    }
}
