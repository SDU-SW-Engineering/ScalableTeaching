<?php

use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskTypeEnum;
use App\Models\Task;
use App\Modules\BuildTracking\BuildTracking;
use App\Modules\LinkRepository\LinkRepository;
use App\Modules\MarkAsDone\MarkAsDone;
use App\Modules\ModuleService;
use App\Modules\Subtasks\Subtasks;
use App\Modules\Template\Template;
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
        $service = app(ModuleService::class);
        Task::whereNull('module_configuration')->each(function(Task $task) use ($service) {
            if($task->source_project_id != null)
            {
                // Link repository
                $service->install(LinkRepository::class, $task);
                /** @var LinkRepository $linkModule */
                $linkModule = $task->module_configuration->resolveModule(LinkRepository::class);
                $linkModule->settings()->repo = $task->source_project_id;
                $task->module_configuration->update(LinkRepository::class, $linkModule->settings(), $task);

                if($task->correction_type != CorrectionType::Self)
                {
                    if($task->type != TaskTypeEnum::Exercise)
                        $service->install(BuildTracking::class, $task);

                    $service->install(Template::class, $task);
                }
            }

            if($task->sub_tasks != null && $task->sub_tasks->count() > 0)
            {
                $service->install(Subtasks::class, $task);
            }

            // Self grading
            if($task->correction_type == CorrectionType::Self)
            {
                $service->install(MarkAsDone::class, $task);
            }
            $task->save();
        });
        Schema::table('tasks', function(Blueprint $table) {
            $table->dropColumn(['source_project_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function(Blueprint $table) {
            $table->bigInteger('source_project_id')->unsigned()->after('track_id')->nullable();
            $table->enum('type', ['assignment', 'exercise'])->default('assignment');
        });

        Task::whereNotNull('module_configuration')->each(function(Task $task) {
            if($task->module_configuration->hasInstalled(LinkRepository::class))
            {
                /** @var LinkRepository $linkRepoModule */
                $linkRepoModule = $task->module_configuration->resolveModule(LinkRepository::class);
                $task->source_project_id = $linkRepoModule->settings()->repo;
                $task->save();
            }
        });

        Task::whereNotNull('module_configuration')->update(['module_configuration' => null]);
    }
};
