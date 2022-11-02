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
        Schema::table('project_feedback_comments', function (Blueprint $table) {
            $table->string('filename')->nullable()->change();
            $table->string('line')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_feedback_comments', function (Blueprint $table) {
            $table->string('filename')->change();
            $table->string('line')->change();
        });
    }
};
