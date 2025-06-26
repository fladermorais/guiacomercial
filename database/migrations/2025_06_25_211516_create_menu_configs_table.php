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
        Schema::create('menu_configs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('cat_blogs');
            $table->string('alias');
            $table->enum('exibe_menu', ['S', 'N'])->default('N');
            $table->enum('exibe_home', ['S', 'N'])->default('N');
            $table->integer('ordem');
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
        Schema::dropIfExists('menu_configs');
    }
};
