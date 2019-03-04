<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qrcode_id');
            $table->integer('qrcode_owner_id')->nullable();
            $table->integer('user_id');
            $table->string('payment_method')->nulllable(); //paypal , paystack , stripe etc
            $table->float('amount', 10, 4)->default(0);
            $table->longText('message')->nullable();
            $table->string('status')->default('initiated'); // initiated , completed and failed , completed and successful
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
