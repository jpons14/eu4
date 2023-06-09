<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSSVisiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_s_visibles', function (Blueprint $table) {
            $table->integer('UserID')->unsigned();
            $table->integer('SolarSystemID')->unsigned();
            $table->timestamps();

            $table->primary(['UserID', 'SolarSystemID']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_s_visibles');
    }
}
