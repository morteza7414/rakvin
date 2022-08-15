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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slut');
            $table->string('email')->nullable();
            $table->string('mobile');
            $table->string('username')->nullable();
            $table->string('phone')->nullable();
            $table->string('role')->default('user');
            $table->string('password');
            $table->string('building')->nullable();
            $table->string('address', 1500)->nullable();
            $table->string('city')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedInteger('identifier_id');
            $table->bigInteger('postalcode')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
