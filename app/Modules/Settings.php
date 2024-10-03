<?php

namespace App\Modules;

use App\Models\Task;
use ReflectionClass;

abstract class Settings implements \JsonSerializable
{
    /**
     * Rules that should be validated before settings can be persisted. Each key in the array should correspond
     * to a property on the settings class.
     * @return array Laravel validation rules
     */
    public function validationRules(Task $task): array
    {
        return [];
    }

    /**
     * This method can be overwritten to add additional values that can be used in the UI to further enhance the experience.
     */
    public function additionalValues(): array
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
