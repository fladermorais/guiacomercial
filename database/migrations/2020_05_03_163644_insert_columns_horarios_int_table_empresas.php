<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertColumnsHorariosIntTableEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('segunda')->nullable();
            $table->string('segunda_final')->nullable();
            $table->string('terca')->nullable();
            $table->string('terca_final')->nullable();
            $table->string('quarta')->nullable();
            $table->string('quarta_final')->nullable();
            $table->string('quinta')->nullable();
            $table->string('quinta_final')->nullable();
            $table->string('sexta')->nullable();
            $table->string('sexta_final')->nullable();
            $table->string('sabado')->nullable();
            $table->string('sabado_final')->nullable();
            $table->string('domingo')->nullable();
            $table->string('domingo_final')->nullable();
            $table->string('feriado')->nullable();
            $table->string('feriado_final')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function(Blueprint $table) {
            $table->dropTable('segunda');
            $table->dropTable('segunda_final');
            $table->dropTable('terca');
            $table->dropTable('terca_final');
            $table->dropTable('quarta');
            $table->dropTable('quarta_final');
            $table->dropTable('quinta');
            $table->dropTable('quinta_final');
            $table->dropTable('sexta');
            $table->dropTable('sexta_final');
            $table->dropTable('sabado');
            $table->dropTable('sabado_final');
            $table->dropTable('domingo');
            $table->dropTable('domingo_final');
            $table->dropTable('feriado');
            $table->dropTable('feriado_final');
        });
    }
}
