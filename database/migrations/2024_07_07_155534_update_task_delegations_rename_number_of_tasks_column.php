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
            $table->renameColumn('number_of_tasks', 'number_of_projects');
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
            $table->renameColumn('number_of_projects', 'number_of_tasks');
        });
    }
};
