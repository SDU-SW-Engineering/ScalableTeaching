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
        Schema::create('course_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('affected_id')->nullable();
            $table->unsignedBigInteger('affected_by_id')->nullable();
            $table->string('resource_type');
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->text('message');
            $table->enum('type', ['created', 'updated', 'deleted']);
            $table->json('additional')->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('affected_id')->references('id')->on('users');
            $table->foreign('affected_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_activities');
    }
};
