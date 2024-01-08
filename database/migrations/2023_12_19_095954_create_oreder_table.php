<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrederTable extends Migration
{
    public function up()
    {
        Schema::create('order', function (Blueprint $table)
        {
            $table->id();
            $table->timestamps();
            $table->enum('method', ['cash', 'online']);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')->on('product')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order');
    }
}
