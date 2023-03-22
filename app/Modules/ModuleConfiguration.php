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
        if (!$this->hasInstalled($identifier))
            return null;
        $modulePath = app(ModuleService::class)->getById($identifier);
        /** @var Module $module */
        $module = new $modulePath;
        /** @var ModuleModel $installed */
        $installed = $this->installed[$identifier];

        return $module->setSettings($installed->settings);
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
