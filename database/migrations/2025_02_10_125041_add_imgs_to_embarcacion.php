<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgsToEmbarcacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('embarcacions', function (Blueprint $table) {
            $table->string('image_path5')->nullable()->default(null)->after('image_path4');
            $table->string('image_path6')->nullable()->default(null)->after('image_path5');
            $table->string('image_path7')->nullable()->default(null)->after('image_path6');
            $table->string('image_path8')->nullable()->default(null)->after('image_path7');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('embarcacions', function (Blueprint $table) {
            $table->dropColumn('image_path5');
            $table->dropColumn('image_path6');
            $table->dropColumn('image_path7');
            $table->dropColumn('image_path8');
        });
    }
}
