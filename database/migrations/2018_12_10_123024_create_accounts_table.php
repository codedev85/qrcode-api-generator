<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->float('balance', 10, 4)->default(0);
            $table->float('total_credit', 10, 4)->default(0);
            $table->float('total_debit', 10, 4)->default(0);
            $table->string('withrawal_method')->default('bank');

            $table->integer('applied_for_payouts')->default(0);
            $table->date('last_date_applied')->nullable();
            $table->date('last_date_paid')->nullable();
            $table->integer('paid')->default(0);

            $table->string('payment_email')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('country')->nullable();
            $table->longText('other_details')->nullable();

            $table->longText('payment_details');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
