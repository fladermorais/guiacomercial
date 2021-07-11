<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertColunSubcategoriaInTableEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->bigInteger('subcategoria_id')->unsigned()->nullable();
            $table->foreign('subcategoria_id')->references('id')->on('sub_categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropForeign('empresas_subcategoria_id_foreign');
            $table->dropColumn('subcategoria_id');
        });
    }
}
