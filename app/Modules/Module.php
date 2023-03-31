<?php

namespace App\Modules;

use Illuminate\Support\Str;
use ReflectionClass;

abstract class Module
{
    protected string $name = "";

    protected string $icon = "";

    protected string $description = "";

    private ?Settings $settings;

    public function __construct()
    {
        $this->settings = $this->loadSettings();
    }

    /**
     * @var array list of modules this module depends on
     */
    protected array $dependencies = [];

    /**
     * @var array list of modules that conflicts with this one
     */
    protected array $conflicts = [];

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function icon(): string
    {
        return $this->icon;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function identifier(): string
    {
        return class_basename($this);
    }

    /**
     * @return array
     */
    public function dependencies(): array
    {
        return $this->dependencies;
    }

    public function conflicts(): array
    {
        return $this->conflicts;
    }

    /**
     * Allows each module to have a settings
     * @return Settings|null
     */
    protected function loadSettings(): ?Settings
    {
        return null;
    }

    public function settings(): ?Settings
    {
        return $this->settings;
    }

    public function setSettings(Settings $settings): Module
    {
        $this->settings = $settings;
        return $this;
    }

    public function __toString(): string
    {
        return $this->identifier();
    }

    public function isEnabled(Settings|null $settings): bool
    {
        return true;
    }

    public static function configRoutes(): void
    {
    }

    public static function routes(): void
    {
    }

    private function basePath(): string
    {
        $reflection = new ReflectionClass(get_class($this));
        return dirname($reflection->getFileName());
    }

    private function viewPath(string $path = null): string
    {
        return $this->basePath() . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . ($path == null ? '' : $path);
    }

    private function widgetPath(string $path = null): string
    {
        return $this->viewPath('Widgets') . DIRECTORY_SEPARATOR . ($path == null ? '' : $path);
    }

    /**
     * @return bool
     */
    public function hasSidebar(): bool
    {
        return file_exists($this->viewPath("sidebar.blade.php")) | file_exists($this->viewPath('sidebar.php'));
    }

    public function bigWidgets()
    {
        $path = $this->widgetPath('Big');
        if (!file_exists($path))
            return [];
        $filtered = array_values(preg_filter('/(.)(?:\.blade)?\.php/', '${1}', scandir($path)));
        dd($filtered, $this->basePath() . DIRECTORY_SEPARATOR . Str::studly($filtered[0]), __DIR__);
        return $found;
    }
}
