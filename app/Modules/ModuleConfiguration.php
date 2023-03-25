<?php

namespace App\Modules;

use App\Models\Task;
use App\Modules\LinkRepository\LinkRepository;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ModuleConfiguration implements Castable
{
    private array $installed = [];

    /**
     * @param bool $raw Specifies if all modules should be returned, also once that are no longer installed but have been in the past.
     * @return array
     */
    public function installed(bool $raw = false): array
    {
        if($raw)
            return $this->installed;
        return array_filter($this->installed, fn(ModuleModel $model) => $model->installed);
    }

    public function enabled(): array
    {
        return array_filter($this->installed(), fn(ModuleModel $model) => $model->enabled);
    }

    public function hasInstalled(string $identifier): bool
    {
        return array_key_exists($identifier, $this->installed());
    }

    public function isEnabled(Module|string $module): bool
    {
        if($module instanceof Module)
            $module = $module->identifier();
        if(!$this->hasInstalled($module))
            return false;
        return $this->installed[$module]->enabled;
    }

    public function resolveModule(string $identifier): Module|null
    {
        if(!$this->hasInstalled($identifier))
            return null;
        $modulePath = app(ModuleService::class)->getById($identifier);
        /** @var Module $module */
        $module = new $modulePath;
        /** @var ModuleModel $installed */
        $installed = $this->installed[$identifier];
        if($installed->settings == null)
            return $module;

        return $module->setSettings($installed->settings);
    }

    public function canUninstall(string $identifier): bool
    {
        foreach($this->installed() as $name => $moduleModel) {
            if($identifier == $name)
                continue; // we don't care about ourselves

            $conflicts = array_filter($this->resolveModule($name)->dependencies(), fn(string $dependency) => class_basename($dependency) == $identifier);
            if(count($conflicts) == 0)
                continue;

            return false;
        }

        return true;
    }

    /**
     * @param array $installed
     */
    public function setInstalled(array $installed): void
    {
        $this->installed = $installed;
    }

    public function addModule(string $modulePath): void
    {
        /** @var Module $module */
        $module = new $modulePath;
        $baseName = class_basename($modulePath);
        if(array_key_exists($baseName, $this->installed)) {
            /** @var ModuleModel $model */
            $model = $this->installed[$baseName];
            $model->setInstalled(true);
            $model->setEnabled($module->isEnabled($model->settings));
            return;
        }
        $model = new ModuleModel(false, $module->settings());
        $model->setInstalled(true);
        $model->setEnabled($module->isEnabled($model->settings));
        $this->installed[$baseName] = $model;
    }

    public function update(string $module, Settings $settings): void
    {
        /** @var ModuleModel $moduleModel */
        $moduleModel = $this->installed[$module];
        $module = $this->resolveModule($module);
        $moduleModel->setSettings($settings);
        $moduleModel->setEnabled($module->isEnabled($settings));
    }

    public function uninstall(Module $module): void
    {
        if(!$this->canUninstall($module->identifier()))
            return;
        /** @var ModuleModel $model */
        $model = $this->installed[$module->identifier()];
        $model->setInstalled(false);
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new class implements CastsAttributes {

            public function get($model, string $key, $value, array $attributes)
            {
                $configuration = new ModuleConfiguration();
                if($value == null)
                    return $configuration;
                $modules = json_decode($value, true);
                array_walk($modules, function(&$moduleSettings, $moduleName) {
                    $moduleSettings = ModuleModel::fromConfiguration($moduleName, $moduleSettings);
                });
                $configuration->setInstalled($modules);
                return $configuration;
            }

            public function set($model, string $key, $value, array $attributes)
            {
                /** @var ModuleConfiguration $configuration */
                $configuration = $value;
                return [
                    $key => json_encode($configuration->installed(true))
                ];
            }
        };
    }
}
