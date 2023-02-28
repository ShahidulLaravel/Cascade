<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('name');
            $table->string('ship_name');
            $table->string('email')->unique();
            $table->string('ship_email')->unique();
            $table->string('company')->nullable();
            $table->integer('bill_phone');
            $table->integer('ship_phone');
            $table->integer('additional_phone')->unique();
            $table->string('address');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code');
            $table->longText('additional')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
};
