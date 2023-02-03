<?php

use App\Models\Enums\CorrectionType;
use App\Models\Task;
use Illuminate\Database\Migrations\Migration;

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
        Task::where('correction_type', 'manual')->update([
            'correction_type' => CorrectionType::None,
        ]);
        DB::statement("ALTER TABLE `tasks` CHANGE `correction_type` `correction_type` ENUM('none','pipeline_success','all_tasks','required_tasks','number_of_tasks','points_required')");
    }
};
