<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = ['ownable_id', 'ownable_type', 'response'];

    protected $casts = [
        'response' => 'array'
    ];

    public function ownable() : MorphTo
    {
        return $this->morphTo();
    }

    public function scopeUsers($query)
    {
        return $query->where('ownable_type', User::class);
    }

    public function scopeUser($query, int $userId)
    {
        return $query->where('ownable_type', User::class)->where('ownable_id', $userId);
    }
}
