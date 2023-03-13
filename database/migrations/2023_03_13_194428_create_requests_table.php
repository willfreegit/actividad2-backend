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
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('req_id');
            $table->unsignedBigInteger('epl_id');
            $table->unsignedBigInteger('abs_id');
            $table->date('req_entry_request_date');
            $table->string('req_status', 10);
            $table->date('req_absence_start_date');
            $table->date('req_absence_end_date');
            $table->integer('req_days_requested');
            $table->string('req_comments');
            $table->foreign('epl_id')->references('epl_id')->on('employees');
            $table->foreign('abs_id')->references('abs_id')->on('absences');
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
        Schema::dropIfExists('requests');
    }
};
