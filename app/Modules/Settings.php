<?php

namespace App\Modules;

use ReflectionClass;

abstract class Settings implements \JsonSerializable
{
    /**
     * Rules that should be validated before settings can be persisted. Each key in the array should correspond
     * to a property on the settings class.
     * @return array Laravel validation rules
     */
    public function validationRules(): array
    {
        return [];
    }

    public function jsonSerialize(): mixed
    {
        $values = [];
        $reflect = new ReflectionClass($this);
        foreach($reflect->getProperties() as $property)
        {
            $values[$property->getName()] = $property->getValue($this);
        }

        return $values;
    }
}
