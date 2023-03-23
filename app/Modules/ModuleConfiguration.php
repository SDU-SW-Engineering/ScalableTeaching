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
     * @return array
     */
    public function installed(): array
    {
        return $this->installed;
    }

    public function hasInstalled(string $identifier): bool
    {
        return array_key_exists($identifier, $this->installed);
    }

    public function resolveModule(string $identifier)
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

    public function canUninstall(string $identifier)
    {
        foreach($this->installed as $name => $moduleModel) {
            if($identifier == $name)
                continue; // we don't care about ourselves


            $conflicts = array_filter($this->resolveModule($name)->dependencies(), fn(string $dependency) => class_basename($dependency) == $identifier);

            if (count($conflicts) == 0)
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

    public function addModule(string $modulePath)
    {
        $module = new $modulePath;
        $this->installed[class_basename($modulePath)] = new ModuleModel(false, $module->settings());
    }

    public function update(string $module, Settings $settings)
    {
        /** @var ModuleModel $moduleModel */
        $moduleModel = $this->installed[$module];
        $moduleModel->setSettings($settings);
    }

    public function uninstall(Module $module)
    {
        if (!$this->canUninstall($module->identifier()))
            return;
        unset($this->installed[$module->identifier()]);
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
                    $key => json_encode($configuration->installed())
                ];
            }
        };
    }
}
