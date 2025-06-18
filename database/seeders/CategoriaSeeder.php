<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::firstOrCreate([
            "nome"  =>  "Animais",
            "alias"   =>  "animais",
            "descricao"   =>  "Produtos e serviçoes relacionados a animais",
            "status"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Alimentação",
            "alias"   =>  "alimentacao",
            "descricao"   =>  "Produtos e serviçoes relacionados a alimentação",
            "status"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Educação",
            "alias"   =>  "educacao",
            "descricao"   =>  "Produtos e serviçoes relacionados a educação",
            "status"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Estética",
            "alias"   =>  "estetica",
            "descricao"   =>  "Produtos e serviçoes relacionados a estética",
            "status"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Saúde",
            "alias"   =>  "saude",
            "descricao"   =>  "Produtos e serviçoes relacionados a saúde",
            "status"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Serviços",
            "alias"   =>  "servicos",
            "descricao"   =>  "Serviços em geral",
            "status"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Vestuário",
            "alias"   =>  "vestuario",
            "descricao"   =>  "Produtos e serviçoes relacionados a vestuário",
            "status"   =>  "sim",
            ]
        );
    }
}
