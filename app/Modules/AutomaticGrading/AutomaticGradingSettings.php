<?php

namespace App\Modules\AutomaticGrading;

use App\Modules\Settings;
use Illuminate\Validation\Rule;

class AutomaticGradingSettings extends Settings
{
    public ?string $gradingType = null;

    public function validationRules(): array
    {
        return [
            'gradingType' => ['required', Rule::enum(AutomaticGradingType::class)],
        ];
    }

    public function isPipelineBased(): bool
    {
        return $this->gradingType == AutomaticGradingType::PIPELINE_SUCCESS->value;
    }

}
