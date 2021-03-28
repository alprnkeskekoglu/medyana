<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->tinyInteger('status')->default(1);
            $table->string('name');
            $table->date('supply_date')->nullable();
            $table->integer('stock');
            $table->float('unit_price', 6)->default(0.01);
            $table->float('rate', 5);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipments');
    }
}
