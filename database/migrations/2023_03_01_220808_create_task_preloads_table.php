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
        Schema::create('task_preloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained();
            $table->enum('status', ['claimed', 'unclaimed'])->default('unclaimed');
            $table->unsignedInteger('gitlab_project_id');
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
        Schema::dropIfExists('task_preloads');
    }
};
