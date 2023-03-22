<?php

namespace App\Modules;

class ModuleModel implements \JsonSerializable
{
    public bool $enabled = false;
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

    public static function fromConfiguration(string $moduleName, array $settings): ModuleModel
    {
        $modulePath = app(ModuleService::class)->getById($moduleName);
        /** @var Module $module */
        $module = new $modulePath;
        if($module->settings() == null)
            return new ModuleModel($settings['enabled'], $module->settings());

        foreach($settings['settings'] as $property => $value)
            $module->settings()->$property = $value;

        return new ModuleModel($settings['enabled'], $module->settings());
    }
}
