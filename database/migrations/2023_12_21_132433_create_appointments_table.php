<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{

    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->string('service',50);
            $table->string('stylist',50);
            $table->dateTime('appointment_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
