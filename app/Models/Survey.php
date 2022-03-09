<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Survey extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function fields(): HasMany
    {
        return $this->hasMany(SurveyField::class);
    }

    public function responses() : HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
