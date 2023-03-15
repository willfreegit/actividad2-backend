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
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->string('lastname', 40);
            $table->string('DNI', 8);
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->string('phone', 12)->Nulleable();
            $table->string('country', 25)->Nulleable();
            $table->string('IBAN', 24);
            $table->string('about', 250)->Nulleable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
