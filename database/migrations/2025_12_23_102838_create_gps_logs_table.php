<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGpsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gps_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->double('lat', 10, 8);
            $table->double('lng', 11, 8);
            $table->float('speed')->nullable(); // Velocidad del repartidor
            $table->float('alt')->nullable();   // Altitud
            $table->string('device_info')->nullable(); 
            $table->timestamp('recorded_at');    // El tiempo exacto del GPS
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
        Schema::dropIfExists('gps_logs');
    }
}
