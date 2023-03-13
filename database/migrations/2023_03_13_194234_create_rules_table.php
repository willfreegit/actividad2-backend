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
        Schema::create('rules', function (Blueprint $table) {
            $table->bigIncrements('rul_id');
            $table->unsignedBigInteger('ben_id');
            $table->integer('rul_min_value_for_calculation');
            $table->integer('rul_max_value_for_calculation');
            $table->integer('rul_number_of_benefit_days');
            $table->integer('rul_sequential_aplicacion_rule');
            $table->foreign('ben_id')->references('ben_id')->on('benefits');
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
        Schema::dropIfExists('rules');
    }
};
