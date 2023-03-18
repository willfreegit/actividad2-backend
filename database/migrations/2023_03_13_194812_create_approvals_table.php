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
        Schema::create('approvals', function (Blueprint $table) {
            $table->bigIncrements('aut_id');
            $table->unsignedBigInteger('req_id');
            $table->unsignedBigInteger('epl_approval_id');
            $table->integer('aut_sequential_approval_flow');
            $table->date('aut_submission_date_for_approval');
            $table->date('aut_approval_action_date')->nullable();
            $table->string('aut_action', 10);
            $table->string('aut_approval_comments', 10)->nullable();
            $table->foreign('req_id')->references('req_id')->on('requests');
            $table->foreign('epl_approval_id')->references('epl_id')->on('employees');
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
        Schema::dropIfExists('approvals');
    }
};
