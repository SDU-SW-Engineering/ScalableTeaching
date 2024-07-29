<?php

namespace App\Modules\PreloadRepositories;

use App\Models\Task;
use App\Modules\Settings;

class PreloadRepositoriesSettings extends Settings
{
    public int $availability = 80;

    public function validationRules(Task $task): array
    {
        return [
            'availability' => ['required', 'integer'],
        ];
    }
}
