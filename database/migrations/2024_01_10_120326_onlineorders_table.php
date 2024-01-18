<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OnlineordersTable extends Migration
{
    public function up()
    {
        Schema::create('onlineorders', function (Blueprint $table)
        {
            $table->id();
            $table->string('categories', 50);
            $table->string('service', 50);
            $table->enum('type', ['appointment', 'order'])->nullable();
            $table->dateTime('date');
            $table->enum('status', ['Active', 'Inactive'])->nullable();
            $table->integer('user_id');
            $table->integer('service_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('onlineorders');
    }
}
