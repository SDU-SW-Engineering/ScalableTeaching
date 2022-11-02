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
        Schema::table('project_sub_tasks', function (Blueprint $table) {
            $table->dropForeign('project_sub_tasks_pipeline_id_foreign');
            $table->dropColumn('pipeline_id');
            $table->string('source_type')->after('sub_task_id');
            $table->unsignedBigInteger('source_id')->after('source_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_sub_tasks', function (Blueprint $table) {
            $table->dropColumn(['source_type', 'source_id']);

            $table->unsignedBigInteger('pipeline_id');

            $table->foreign('pipeline_id')->references('id')->on('pipelines');
        });
    }
};
