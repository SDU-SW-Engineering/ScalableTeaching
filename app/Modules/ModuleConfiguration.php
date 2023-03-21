<?php

namespace App\Modules;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ModuleConfiguration implements Castable
{
    public array $installed = [];

    public static function castUsing(array $arguments) : CastsAttributes
    {
        return new class implements CastsAttributes {

            public function get($model, string $key, $value, array $attributes)
            {
                if ($value == null)
                    return new ModuleConfiguration();
                dd($key, $value, 2);
                // TODO: Implement get() method.
            }

            public function set($model, string $key, $value, array $attributes)
            {
                // TODO: Implement set() method.
            }
        };
    }
}
