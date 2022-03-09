<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SurveyTask extends Pivot
{
    protected $casts = [
        'required' => 'boolean'
    ];
}
