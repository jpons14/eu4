<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanetsResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets_resources', function (Blueprint $table) {
            $table->id();
            $table->integer('PlanetID')->unsigned()->nullable();
            $table->integer('ResourceTypeID')->unsigned()->nullable();
            $table->integer('Percentage');
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
        Schema::dropIfExists('planets_resources');
    }
}
