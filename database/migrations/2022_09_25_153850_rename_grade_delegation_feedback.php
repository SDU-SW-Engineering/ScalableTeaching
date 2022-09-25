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
        Schema::rename('grade_delegations', 'project_feedback');
        Schema::table('project_feedback', function(Blueprint $table) {
            $table->unsignedBigInteger('task_delegation_id')->after('project_id')->nullable();
            $table->boolean('grading')->after('pseudonym');
            $table->boolean('feedback')->after('grading');
            $table->string('sha')->nullable()->after('feedback');
            $table->boolean('reviewed')->default(false)->comment('indicates that the user_id has finished reviewing this delegation.');

            $table->foreign('task_delegation_id')->references('id')->on('task_delegations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_feedback', function(Blueprint $table) {
            $table->dropForeign(['task_delegation_id']);
            $table->dropColumn(['grading', 'feedback', 'task_delegation_id','sha']);
        });
        Schema::rename('project_feedback', 'grade_delegations');
    }
};
