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
        Schema::create('trip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_origin_city');
            $table->unsignedBigInteger('id_destination_city');
            $table->string('travel_time');
            $table->string('departure_time');
            $table->string('arrival_time');
            $table->double('price');
            $table->unsignedBigInteger('id_class_service'); //primera, turista
            $table->unsignedBigInteger('id_ticket'); //ida, ida vuelta
            $table->unsignedBigInteger('id_passenger_type'); //tipo pasajero niño, adulto
            $table->timestamps();

            $table->foreign('id_origin_city')
                ->references('id')
                ->on('city');

            $table->foreign('id_destination_city')
                ->references('id')
                ->on('city');

            $table->foreign('id_class_service')
                ->references('id')
                ->on('class_service');

            $table->foreign('id_ticket')
                ->references('id')
                ->on('ticket_type');

            $table->foreign('id_passenger_type')
                ->references('id')
                ->on('passenger_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip');
    }
};
