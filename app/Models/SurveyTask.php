<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property-read bool $isPastDeadline
 */
class SurveyTask extends Pivot
{
    protected $dates = ['deadline'];

    public function isPastDeadline() : Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => now()->isAfter($attributes['deadline'])
        );
    }
}
