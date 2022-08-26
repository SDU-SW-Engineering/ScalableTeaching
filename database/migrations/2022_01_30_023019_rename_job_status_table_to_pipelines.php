<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameJobStatusTableToPipelines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('job_statuses', 'pipelines');
        Schema::table('pipelines', function(Blueprint $table) {
            $table->dropColumn(['repo_name', 'repo_branch', 'user_email', 'history', 'log', 'runner']);
            $table->renameColumn('build_id', 'pipeline_id');
            $table->json('runners')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pipelines', function(Blueprint $table) {
            $table->dropColumn('runners');
            $table->renameColumn('build_id', 'pipeline_id');
            $table->string('repo_name');
            $table->string('repo_branch');
            $table->string('user_email');
            $table->string('runner');
        });
        Schema::rename('pipelines', 'job_statuses');
    }
}
