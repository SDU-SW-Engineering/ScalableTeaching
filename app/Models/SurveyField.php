<?php

namespace App\Models;

use App\Models\Enums\SurveyFieldType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyField extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'has_options' => 'boolean',
        'type'        => SurveyFieldType::class,
        'required'    => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(SurveyFieldItem::class);
    }
}
