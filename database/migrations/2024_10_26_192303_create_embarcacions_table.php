<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmbarcacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embarcacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')
                ->on('areas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('user_id');
            $table->bigInteger('comercio_id');
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('subcategory_id')->nullable();
            $table->json('subcategories')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('image_path1')->nullable();
            $table->string('image_path2')->nullable();
            $table->string('image_path3')->nullable();
            $table->string('image_path4')->nullable();
            $table->string('video_path1')->nullable();
            $table->bigInteger('manufacturer_id')->nullable();            
            $table->string('details1')->nullable();
            $table->string('condition')->nullable();
            $table->string('eslora')->nullable(); //Eslora (largo): 47
            $table->string('manga')->nullable();
            $table->string('fe_fabricacion')->nullable();
            $table->string('color')->nullable();
            $table->string('material')->nullable();
            $table->string('maximumcrew')->nullable(); // Tripulación maxima
            $table->string('nroengines')->nullable(); // Nro de motores
            $table->string('anno_motor')->nullable();
            $table->string('enginebrand')->nullable(); //marca del motor
            $table->string('enginemodel')->nullable(); //modelo del motor
            $table->string('enginetype')->nullable(); //tipo de motor
            $table->string('hoursofuse')->nullable(); //horas de uso
            $table->string('power')->nullable(); //poder HP
            $table->string('estereo')->nullable(); //
            $table->string('negotiable')->nullable(); // Negociable
            $table->string('additional_information')->nullable(); // Negociable
            $table->string('currency')->nullable();
            $table->decimal('price1',12, 2)->nullable();
            $table->decimal('price2',12, 2)->nullable();
            $table->decimal('price_offer',12,2)->nullable(); //precio de oferta
            $table->decimal('price_divisa',12,2)->nullable(); //precio del dolar cuando se adquirió
            $table->decimal('stock_min',12,2)->nullable();
            $table->decimal('stock_max',12,2)->nullable();
            $table->decimal('stock')->nullable(); // cant en almacen
            $table->string('in_pickup')->nullable()->default('1'); // Si o No
            $table->string('in_delivery')->nullable()->default('1'); // Si o No
            $table->string('in_envio_nacional')->nullable()->default('0'); // Si o No
            $table->string('madein')->nullable();
            $table->string('in_cart')->nullable()->default('0');
            $table->string('in_pedido')->nullable();
            $table->string('in_offer')->nullable()->default('0');
            $table->integer('ca_valoracion')->nullable();
            $table->string('in_valido')->nullable()->default('1');

            $table->string('matricula')->nullable();
            $table->string('distintivollamada')->nullable();
            $table->string('nroomi')->nullable();
            $table->string('nrommsi')->nullable();
            $table->string('armador')->nullable();
            $table->string('operador')->nullable();
            $table->string('puntal')->nullable();
            $table->string('arqueobruto')->nullable();
            $table->string('arqueoneto')->nullable();
            $table->string('capacidadcombustible')->nullable();
            $table->string('capacidadalmacenamiento')->nullable();
            $table->string('puertoregistro')->nullable();
            $table->string('artepesca')->nullable();

            $table->bigInteger('userCreated_at');
            $table->bigInteger('userUpdated_at');
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
        Schema::dropIfExists('embarcacions');
    }
}
