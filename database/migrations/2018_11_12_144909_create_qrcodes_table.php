<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQrcodesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('qrcodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('website')->nullable();
            $table->string('company_name');
            $table->string('product_name');
            $table->string('product_url')->nullable();
            $table->string('qrcode_path')->nullable();
            $table->string('callback_url');
            $table->float('ammount', 10, 4)->default(0);
            $table->tinyInteger('status')->default(1)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('qrcodes');
    }
}
