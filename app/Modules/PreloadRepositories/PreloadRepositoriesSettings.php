<?php

namespace App\Modules\PreloadRepositories;

use App\Modules\Settings;

class PreloadRepositoriesSettings extends Settings
{
    public int $availability = 80;

    public function validationRules(): array
    {
        return [
            'availability' => ['required', 'integer'],
        ];
    }
}
