<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlineorders', function (Blueprint $table) {
            $table->id();
            $table->string('package',50)->nullable();
            $table->string('categories',50)->nullable();
            $table->string('service',50)->nullable();
            $table->string('address',100);
            $table->string('city',20);
            $table->string('state',20)->nullable();
            $table->integer('zipcode');
            $table->dateTime('appointment_time');
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
        Schema::dropIfExists('onlineorders');
    }
}
