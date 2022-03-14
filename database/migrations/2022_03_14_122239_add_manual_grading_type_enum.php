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
        DB::statement("ALTER TABLE `tasks` CHANGE `correction_type` `correction_type` ENUM('none','pipeline_success','all_tasks','required_tasks','number_of_tasks','points_required', 'manual')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `tasks` CHANGE `correction_type` `correction_type` ENUM('none','pipeline_success','all_tasks','required_tasks','number_of_tasks','points_required')");
    }
};
