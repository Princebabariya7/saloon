<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 50);
            $table->string('detail', 100);
            $table->string('price', 50);
            $table->string('duration', 50);
            $table->string('image',100);
            $table->enum('status', ['Active', 'Inactive']);
            $table->integer('category_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
