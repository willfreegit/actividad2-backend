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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('epl_id');
            $table->string('epl_identity_document', 15);
            $table->string('epl_name', 60);
            $table->string('epl_lastname', 60);
            $table->date('epl_DOB');
            $table->string('epl_document_type', 1);
            $table->string('epl_email', 50)->nullable();
            $table->date('epl_last_entry_date')->nullable();
            $table->date('epl_last_exit_date')->nullable();
            $table->string('epl_employee_status', 8);
            $table->unsignedBigInteger('dep_id');
            $table->foreign('dep_id')->references('dep_id')->on('departments');
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
        Schema::dropIfExists('employees');
    }
};
