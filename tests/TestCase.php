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

    public function installLinkRepositoryModule(Task $task): void
    {
        $task->module_configuration->addModule(LinkRepository::class);
        $settings = new LinkRepositorySettings();
        $settings->repo = "mock-id";
        $task->module_configuration->update(LinkRepository::class, $settings, $task);
        $task->module_configuration->resolveModule(LinkRepository::class)->update($task);
    }

    public function installTemplateModule(Task $task): void
    {
        $task->module_configuration->addModule(Template::class);
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
