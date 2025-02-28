<?php

namespace Tests;

use App\Models\Task;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use App\Modules\AutomaticGrading\AutomaticGradingType;
use App\Modules\BuildTracking\BuildTracking;
use App\Modules\LinkRepository\LinkRepository;
use App\Modules\LinkRepository\LinkRepositorySettings;
use App\Modules\Template\Template;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function installLinkRepositoryModule(Task $task, string $repoID = "mock-id"): void
    {
        $task->module_configuration->addModule(LinkRepository::class);
        $settings = new LinkRepositorySettings();
        $settings->repo = $repoID;
        $task->module_configuration->update(LinkRepository::class, $settings, $task);
        $task->module_configuration->resolveModule(LinkRepository::class)->update($task);
        $task->save();
    }

    public function installTemplateModule(Task $task): void
    {
        $task->module_configuration->addModule(Template::class);
        $task->save();
    }

    public function installBuildTrackingModule(Task $task): void
    {
        $task->module_configuration->addModule(BuildTracking::class);
    }

    public function installAutomaticGradingModule(Task $task, AutomaticGradingType $gradingType, ?int $pointsRequired = null, array $requiredSubtaskIds = [], ): void
    {
        $task->module_configuration->addModule(AutomaticGrading::class);
        $settings = new AutomaticGradingSettings();
        $settings->gradingType = $gradingType->value;
        $settings->requiredSubtaskIds = $requiredSubtaskIds;
        $settings->pointsRequired = $pointsRequired;

        $task->module_configuration->update(AutomaticGrading::class, $settings, $task);
        $task->module_configuration->resolveModule(AutomaticGrading::class)->update($task);
    }
}
