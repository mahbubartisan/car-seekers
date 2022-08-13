<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('image');
            $table->string('company');
            $table->string('model');
            $table->tinyInteger('seat_capacity');
            $table->string('color');
            $table->enum('fuel_type',['gas','oil']);
            $table->enum('gear_type',['auto','manual']);
            $table->string('registration_number');
            $table->tinyInteger('availability');
            $table->enum('air_condition',['yes','no']);
            $table->float('minimum_charge');
            $table->float('hourly_charge');
            $table->enum('status',['Pending','Approved','Disapproved']);
            $table->text('status_note')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
