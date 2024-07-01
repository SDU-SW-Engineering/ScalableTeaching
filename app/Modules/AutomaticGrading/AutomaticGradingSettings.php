<?php

namespace App\Modules\AutomaticGrading;

use App\Modules\Settings;
use Illuminate\Validation\Rule;

class AutomaticGradingSettings extends Settings
{
    public ?string $gradingType = null;

    // Only used when gradingType == REQUIRED_SUBTASKS
    public ?array $requiredSubtaskIds = [];

    public function validationRules(): array
    {
        return [
            'gradingType'         => ['required', Rule::enum(AutomaticGradingType::class)],
            '$requiredSubtaskIds' => ['array'],
        ];
    }

    public function isPipelineBased(): bool
    {
        return $this->gradingType == AutomaticGradingType::PIPELINE_SUCCESS->value;
    }

    public function getGradingType(): AutomaticGradingType
    {
        return AutomaticGradingType::from($this->gradingType);
    }

}
