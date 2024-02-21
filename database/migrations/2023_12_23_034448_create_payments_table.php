<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('payment', function (Blueprint $table)
        {
            $table->id();
            $table->string('buyer_name', 50);
            $table->string('buyer_email', 50);
            $table->string('transaction_id');
            $table->json('transaction_detail');
            $table->string('gateway', 50);
            $table->integer('appointment_id');
            $table->enum('status', ['Pending', 'Success', 'Cancel'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
