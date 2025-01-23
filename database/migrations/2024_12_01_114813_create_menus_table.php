<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('area_id');
            $table->bigInteger('comercio_id');
            $table->string('texto');
            $table->string('ruta');
            $table->string('origen');
            $table->bigInteger('category_id')->default(0);
            $table->string('menu');
            $table->bigInteger('posicion');
            $table->string('itemMenu')->default('0');
            $table->string('itemSubmenu')->default('0');
            $table->integer('posicionMenu')->default('0');
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
        Schema::dropIfExists('menus');
    }
}
