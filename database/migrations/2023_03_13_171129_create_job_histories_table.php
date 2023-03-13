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
        Schema::create('job_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('epl_id');
            $table->date('job_entry_date');
            $table->date('job_exit_date')->nulleable();
            $table->primary(array('epl_id', 'job_entry_date'));
            $table->foreign('epl_id')->references('epl_id')->on('employees');
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
        Schema::dropIfExists('job_histories');
    }
};
