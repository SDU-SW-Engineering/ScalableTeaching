<?php

namespace App\Modules;

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

    public function hasInstalled(string $identifier) : bool
    {
        return array_key_exists($identifier, $this->installed);
    }

    /**
     * @param array $installed
     */
    public function setInstalled(array $installed): void
    {
        $this->installed = $installed;
    }

    public function addModule(Module $module)
    {
        $this->installed[class_basename($module::class)] = [];
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
                $configuration->setInstalled($modules);
                return $configuration;
            }

            public function set($model, string $key, $value, array $attributes)
            {
                // TODO: Implement set() method.
                /** @var ModuleConfiguration $configuration */
                $configuration = $value;
                return [
                    $key =>  json_encode($configuration->installed())
                ];
            }
        };
    }


}
