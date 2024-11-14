<?php

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::firstOrCreate([
            'nome'  =>  "Itacomércios",
            'quem_somos' => "Somos uma empresa preocupada em fazer a economia local girar",
            'titulo'    =>  "Ajude a economia local",
            "mensagem"  =>  "Conheça os autônomos da sua cidade, e compre deles",
        ]);
    }
}
