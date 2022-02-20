<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuildNameColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table)
        {
            $table->json('sub_tasks')->after('name')->nullable();
            $table
                ->enum('correction_type', ['none', 'pipeline_success', 'all_tasks', 'required_tasks', 'number_of_tasks', 'points_required'])
                ->default('pipeline_success')
                ->after('sub_tasks');
            $table->unsignedInteger('correction_value')->nullable()->after('correction_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table)
        {
            $table->dropColumn(['sub_tasks', 'correction_type', 'correction_value']);
        });
    }
}
