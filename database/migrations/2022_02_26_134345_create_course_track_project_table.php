<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_track_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_track_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->foreign('course_track_id')->references('id')->on('course_tracks');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_track_project');
    }
};
