<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->id();
            $table->integer('SolarSystemID')->unsigned();
            $table->integer('UserID')->unsigned()->nullable();
            $table->integer('x');
            $table->integer('y');
            $table->integer('titanium');
            $table->integer('copper');
            $table->integer('iron');
            $table->integer('aluminium');
            $table->integer('silicon');
            $table->integer('uranium');
            $table->integer('nitrogen');
            $table->integer('hydrogen');
            $table->integer('titanium_multiplier')->nullable();
            $table->integer('copper_multiplier')->nullable();
            $table->integer('iron_multiplier')->nullable();
            $table->integer('aluminium_multiplier')->nullable();
            $table->integer('silicon_multiplier')->nullable();
            $table->integer('uranium_multiplier')->nullable();
            $table->integer('nitrogen_multiplier')->nullable();
            $table->integer('hydrogen_multiplier')->nullable();
            $table->timestamp('last_time_checked')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('planets');
    }
}
