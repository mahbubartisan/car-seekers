<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('package_id');

            $table->string('pick_up');
            $table->string('drop_off');

            $table->date('start_date');
            $table->time('start_time');

            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();

            $table->tinyInteger('duration');
            $table->tinyInteger('extra_duration')->nullable();

            $table->float('discount_amount')->nullable();
            $table->float('total_amount');
            $table->float('total_paid');
            $table->float('total_due')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
