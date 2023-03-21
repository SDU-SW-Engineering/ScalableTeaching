<?php

namespace App\Modules;

use App\Http\Controllers\Task\Admin\ModuleController;

class ModuleService
{
    private $moduleNamespace = "\\App\\Modules";

    private array $registeredModules = [];

    public function registerModule(Module $module): void
    {
        $this->registeredModules[] = $module;
    }


    /**
     * @param Module $module
     * @param ModuleConfiguration $moduleConfiguration Configuration for a given task, used to determine if the given module has is missing any dependencies
     * @return array returns an array of dependencies that are unmet, empty if all dependencies are met
     * @throws \Throwable
     */
    public function unmetDependencies(Module $module, ModuleConfiguration $moduleConfiguration): array
    {
        $installed = array_map(fn($moduleSettings, $moduleName) => dd($moduleSettings), $moduleConfiguration->installed);
        $unmet = [];
        $registeredModules = array_flip(array_map(fn($registeredModule) => $registeredModule::class, $this->registeredModules));
        foreach ($module->dependencies() as $dependency)
        {
            $name = class_basename($dependency);
            throw_unless(array_key_exists($dependency, $registeredModules), \Exception::class, "Module [{$module->name()}] depends on module [$name] which is not registered.");

            if (!array_key_exists($name, $installed))
                $unmet[] = $name;
        }
        return $unmet;
    }

    /**
     * @throws \Throwable
     */
    public function hasInstallProblems(Module $module, ModuleConfiguration $configuration): string|null
    {
        $unmetDependencies = $this->unmetDependencies($module, $configuration);
        if (count($unmetDependencies) > 0)
            return "Requires the \"${unmetDependencies[0]}\" module.";
        if (count($this->unmetDependencies($module, $configuration)) > 0)
            return [];

        // check dependencies
        // individual requiremnts for each module
        return false;
    }

    /**
     * @return array<Module>
     */
    public function modules(): array
    {
        return $this->registeredModules;
    }
}
