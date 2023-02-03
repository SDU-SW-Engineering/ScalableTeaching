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
            $table->dateTime('reviewed_at')->nullable()->after('reviewer_id');
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
            $table->dropColumn(['reviewed_at']);
        });
    }
};
