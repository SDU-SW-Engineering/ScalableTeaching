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
        Schema::table('task_delegations', function (Blueprint $table) {
            $table->enum('type', ['last_pushes', 'succeeding_pushes', 'succeed_last_pushes'])->after('number_of_tasks');
            $table->dateTime('deadline_at')->after('type');
            $table->boolean('delegated')->default(false)->after('deadline_at');
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
            $table->dropColumn(['type', 'deadline_at', 'delegated']);
        });
    }
};
