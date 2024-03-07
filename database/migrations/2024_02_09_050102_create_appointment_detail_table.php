<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentDetailTable extends Migration
{

    public function up()
    {
        Schema::create('appointment_detail', function (Blueprint $table)
        {
            $table->id();
            $table->integer('appointment_id');
            $table->integer('service_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointment_detail');
    }
}
