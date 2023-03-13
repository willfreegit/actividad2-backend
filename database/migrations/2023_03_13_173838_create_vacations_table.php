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
        Schema::create('vacations', function (Blueprint $table) {
            $table->bigIncrements('vac_id');
            $table->string('vac_year', 15);
            $table->date('vac_year_start_date');
            $table->date('vac_year_end_date');
            $table->integer('vac_taken_days');
            $table->integer('vac_balance_annual_days');
            $table->unsignedBigInteger('epl_id');
            $table->foreign('epl_id')->references('epl_id')->on('employees');
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
        Schema::dropIfExists('vacations');
    }
};
