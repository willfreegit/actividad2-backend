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
            $table->bigIncrements('usr_id');
            $table->string('usr_name', 20);
            $table->string('usr_lastname', 40);
            $table->string('usr_DNI', 8);
            $table->string('usr_email', 191)->unique();
            $table->string('usr_password', 191);
            $table->string('usr_phone', 12)->Nulleable();
            $table->string('usr_country', 25)->Nulleable();
            $table->string('usr_IBAN', 24);
            $table->string('user_about', 250)->Nulleable();
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
