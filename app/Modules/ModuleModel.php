<?php

namespace App\Modules;

class ModuleModel implements \JsonSerializable
{
    public bool $enabled = false;
    public bool $installed = false;
    public ?Settings $settings = null;

    /**
     * @param bool $enabled
     * @param Settings|null $settings
     */
    public function __construct(bool $enabled, ?Settings $settings)
    {
        $this->enabled = $enabled;
        $this->settings = $settings;
    }


    public function jsonSerialize(): array
    {
        return [
            'installed' => $this->installed,
            'enabled'  => $this->enabled,
            'settings' => $this->settings
        ];
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @param Settings $settings
     */
    public function setSettings(Settings $settings): void
    {
        $this->settings = $settings;
    }

    /**
     * @return bool
     */
    public function isInstalled(): bool
    {
        return $this->installed;
    }

    /**
     * @param bool $installed
     */
    public function setInstalled(bool $installed): void
    {
        $this->installed = $installed;
    }

    public static function fromConfiguration(string $moduleName, array $settings): ?ModuleModel
    {
        $modulePath = app(ModuleService::class)->getById($moduleName);
        if (!class_exists($modulePath))
            return null;
        /** @var Module $module */
        $module = new $modulePath;
        $model = new ModuleModel($settings['enabled'], $module->settings());
        $model->setInstalled($settings['installed']);
        if($module->settings() == null)
            return $model;

        foreach($settings['settings'] as $property => $value)
            $module->settings()->$property = $value;

        return $model;
    }
}
