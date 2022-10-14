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
        Schema::table('task_delegations', function (Blueprint $table) {
            $table->enum('type', ['last_pushes', 'succeeding_pushes', 'succeed_last_pushes'])->after('number_of_tasks');
            $table->boolean('grading')->after('type');
            $table->boolean('feedback')->after('grading');
            $table->boolean('is_anonymous')->default(true)->after('feedback')->comment('recipients can\'t see who gave them feedback');
            $table->boolean('is_moderated')->after('is_anonymous')->default(false);
            $table->dateTime('deadline_at')->after('is_moderated');
            $table->boolean('delegated')->default(false)->after('deadline_at');

            $table->dropForeign('task_delegations_course_role_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_delegations', function (Blueprint $table) {
            $table->dropColumn(['type', 'grading', 'feedback', 'deadline_at', 'delegated', 'is_moderated']);
            $table->foreign('course_role_id')->references('id')->on('course_roles');
        });
    }
};
