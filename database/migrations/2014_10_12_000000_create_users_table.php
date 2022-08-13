<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('avatar'); // must use own image
            $table->enum('gender',['Male','Female','Other']);
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('address');
            $table->string('govt_issued_id'); // government issued photo id, can be passport/nid/driving licence
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status',['Pending','Approved','Disapproved','Suspended']);
            $table->enum('role',['Customer','Renter','Admin']);
            $table->string('paypal_account')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
