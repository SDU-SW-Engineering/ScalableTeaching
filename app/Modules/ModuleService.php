<?php

namespace App\Modules;

use App\Http\Controllers\Task\Admin\ModuleController;
use App\Models\Task;

class ModuleService
{
    private array $registeredModules = [];

    public function registerModule(string $module): void
    {
        $this->registeredModules[] = $module;

    }


    /**
     * @param Module $module
     * @param ModuleConfiguration $moduleConfiguration Configuration for a given task, used to determine if the given module has is missing any dependencies
     * @return array returns an array of dependencies that are unmet, empty if all dependencies are met
     * @throws \Throwable
     */
    private function unmetDependencies(Module $module, ModuleConfiguration $moduleConfiguration): array
    {
        $installed = array_keys($moduleConfiguration->enabled());
        $unmet = [];
        $registeredModules = array_flip($this->registeredModules);
        foreach($module->dependencies() as $dependency)
        {
            $name = class_basename($dependency);
            throw_unless(array_key_exists($dependency, $registeredModules), \Exception::class, "Module [{$module->name()}] depends on module [$name] which is not registered.");
            if( ! in_array($name, $installed))
                $unmet[] = $name;
        }

        return $unmet;
    }

    /**
     * @throws \Throwable
     */
    private function conflictingInstallations(Module $module, ModuleConfiguration $moduleConfiguration): array
    {
        $installed = array_keys($moduleConfiguration->installed());
        $unmet = [];
        $registeredModules = array_flip($this->registeredModules);

        foreach($module->conflicts() as $conflict)
        {
            $name = class_basename($conflict);
            throw_unless(array_key_exists($conflict, $registeredModules), \Exception::class, "Module [{$module->name()}] conflicts with module [$name] which is not registered.");
            if(in_array($name, $installed))
                $unmet[] = $name;
        }

        return $unmet;
    }

    /**
     * @throws \Throwable
     */
    public function hasInstallProblems(string $module, ModuleConfiguration $configuration): string|null
    {
        $unmetDependencies = $this->unmetDependencies((new $module), $configuration);
        if(count($unmetDependencies) > 0)
            return "Requires the \"${unmetDependencies[0]}\" module.";
        $conflictingInstallations = $this->conflictingInstallations((new $module), $configuration);
        if (count($conflictingInstallations) > 0)
            return "Conflicts with the \"${conflictingInstallations[0]}\" module.";

        // check dependencies
        // individual requiremnts for each module
        return null;
    }

    /**
     * @return array<Module>
     */
    public function modules(): array
    {
        return array_map(fn($module) => (new $module), $this->registeredModules);
    }

    public function getById(string $identifier) : null|string
    {
        $found = array_values(array_filter($this->registeredModules, fn($registeredModule) => class_basename($registeredModule) == $identifier));
        if(count($found) == 0)
            return null;

        return $found[0];
    }

    public function install(string $module, Task $task) : void
    {
        $task->module_configuration->addModule($module);
        $task->save();
    }
}
