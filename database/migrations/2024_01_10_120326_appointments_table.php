<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppointmentsTable extends Migration
{
     public function up()
    {
        Schema::create('appointments', function (Blueprint $table)
        {
            $table->id();
            $table->enum('type', ['Appointment', 'HomeService'])->nullable();
            $table->date('date');
            $table->string('time',100);
            $table->enum('status', ['Active', 'Inactive'])->nullable();
            $table->integer('user_id');
            $table->integer('service_id');
             $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
