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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('building');
            $table->string('address',1500);
            $table->string('city');
            $table->string('mobile');
            $table->string('phone')->nullable();
            $table->bigInteger('postalcode')->nullable();
            $table->boolean('has_logo');
            $table->boolean('want_logo');
            $table->text('carts');
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('description',1500)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
