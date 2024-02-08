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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable()->change();
            $table->string("repo_name", 255)->nullable()->change();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('project_id', 'gitlab_project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('gitlab_project_id')->change();
            $table->renameColumn('gitlab_project_id', 'project_id');
            $table->string("repo_name", 255)->change();
        });
    }
};
