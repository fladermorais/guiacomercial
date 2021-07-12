<?php

use App\Categoria;
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
            "ativo"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Alimentação",
            "alias"   =>  "alimentacao",
            "descricao"   =>  "Produtos e serviçoes relacionados a alimentação",
            "ativo"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Educação",
            "alias"   =>  "educacao",
            "descricao"   =>  "Produtos e serviçoes relacionados a educação",
            "ativo"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Estética",
            "alias"   =>  "estetica",
            "descricao"   =>  "Produtos e serviçoes relacionados a estética",
            "ativo"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Saúde",
            "alias"   =>  "saude",
            "descricao"   =>  "Produtos e serviçoes relacionados a saúde",
            "ativo"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Serviços",
            "alias"   =>  "servicos",
            "descricao"   =>  "Serviços em geral",
            "ativo"   =>  "sim",
            ]
        );

        Categoria::firstOrCreate([
            "nome"  =>  "Vestuário",
            "alias"   =>  "vestuario",
            "descricao"   =>  "Produtos e serviçoes relacionados a vestuário",
            "ativo"   =>  "sim",
            ]
        );
    }
}
