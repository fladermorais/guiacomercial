<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('alias');
            
            $table->bigInteger('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('cat_blogs');

            $table->string('imagem')->nullable();
            $table->string('referencia')->nullable();
            $table->string('linkExterno')->nullable();
            $table->longText('descricao');
            $table->integer('views');
            $table->enum('status', ['A', 'I'])->default('A');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('seo_titulo')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_canonical')->nullable();
            $table->longText('seo_descricao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
};
