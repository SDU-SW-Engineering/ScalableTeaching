<?php

namespace App\Modules\AutomaticGrading;

use App\Models\Task;
use App\Modules\Settings;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

/**
 * Contains the configuration for the automatic grading module.
 *
 * Be aware this class can contain stale data, since it is only updated
 * when the specific grading type is used and is not being overwritten.
 */
class AutomaticGradingSettings extends Settings
{
    public ?string $gradingType = null;

    // Only used when gradingType == REQUIRED_SUBTASKS
    public array $requiredSubtaskIds = [];

    // Only used when gradingType == POINTS_REQUIRED
    public ?int $pointsRequired = null;

    public function validationRules(Task $task): array
    {
        $maxPoints = $task->sub_tasks->maxPoints();

        return [
            'gradingType'         => ['required', Rule::enum(AutomaticGradingType::class)],
            'requiredSubtaskIds'  => ['required_if:gradingType,required_subtasks', 'array'],
            'pointsRequired'      => ['required_if:gradingType,points_required', 'integer', 'numeric', 'min:1', 'max:' . $maxPoints],
        ];
    }

    public function isPipelineBased(): bool
    {
        return $this->gradingType == AutomaticGradingType::PIPELINE_SUCCESS->value;
    }

    /**
     * @throws \Exception
     */
    public function getGradingType(): AutomaticGradingType
    {
        $value = AutomaticGradingType::tryFrom($this->gradingType);
        if ( ! $value)
        {
            throw new \Exception('Unknown grading type: ' . $this->gradingType);
        }

        return $value;
    }

    public function getPointsRequired(): int
    {
        if ( ! $this->pointsRequired)
        {
            Log::error('Points required not set but was called from a place that depended on it. Returning 0');

            return 0;
        }

        return $this->pointsRequired;
    }
}
