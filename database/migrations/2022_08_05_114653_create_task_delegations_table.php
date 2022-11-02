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
        Schema::create('task_delegations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('course_role_id');
            $table->unsignedInteger('number_of_tasks');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks');
            //$table->foreign('course_role_id')->references('id')->on('course_roles');
            $table->unique(['task_id', 'course_role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_delegations');
    }
};
