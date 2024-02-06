<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('buyer_name',50);
            $table->string('buyer_email',50);
            $table->string('buyer_address',50);
            $table->string('cd_number',12);
            $table->string('exp_month');
            $table->string('exp_year');
            $table->integer('cvv');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
