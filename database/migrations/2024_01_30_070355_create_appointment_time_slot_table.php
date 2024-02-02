<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTimeSlotTable extends Migration
{

    public function up()
    {
        Schema::create('appointment_time_slot', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('slot',100)->nullable();
            $table->integer('appointment_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointment_time_slot');
    }
}
