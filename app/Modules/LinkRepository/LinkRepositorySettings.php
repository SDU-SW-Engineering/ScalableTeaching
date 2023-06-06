<?php

namespace App\Modules\LinkRepository;

use App\Modules\Settings;

class LinkRepositorySettings extends Settings
{
    public ?string $repo = null;

    public function validationRules(): array
    {
        return [
            'repo' => ['required'],
        ];
    }
}
