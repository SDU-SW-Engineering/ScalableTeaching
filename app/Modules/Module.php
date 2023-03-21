<?php

namespace App\Modules;

abstract class Module
{
    protected string $name = "";

    protected string $icon;

    protected string $description;

    /**
     * @var array list of modules this module depends on
     */
    protected array $dependencies = [];

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
        return $this->identifier;
    }

    /**
     * @return array
     */
    public function dependencies(): array
    {
        return $this->dependencies;
    }
}
