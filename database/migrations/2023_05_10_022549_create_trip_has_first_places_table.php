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
        Schema::create('trip_has_first_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_trip');
            $table->unsignedBigInteger('id_first_place');
            $table->timestamps();

            $table->foreign('id_trip')
                ->references('id')
                ->on('trip');

            $table->foreign('id_first_place')
                ->references('id')
                ->on('first_place_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_has_first_places');
    }
};
