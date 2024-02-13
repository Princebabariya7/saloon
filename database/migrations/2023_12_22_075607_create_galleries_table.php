<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 50);
            $table->string('image', 50);
            $table->enum('status', ['Active', 'Inactive']);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}
