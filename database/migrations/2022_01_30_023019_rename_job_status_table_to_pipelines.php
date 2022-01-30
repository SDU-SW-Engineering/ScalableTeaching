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
            $table->dropColumn(['repo_name', 'repo_branch', 'user_email']);
            $table->addColumn('')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('pipelines', 'job_statuses');
    }
}
