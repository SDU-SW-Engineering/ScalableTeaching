<?php

namespace App\Modules\LinkRepository;

use App\Models\Task;
use App\Modules\Settings;

class LinkRepositorySettings extends Settings
{
    public ?string $repo = null;

    public function validationRules(Task $task): array
    {
        return [
            'repo' => ['required'],
        ];
    }
}
