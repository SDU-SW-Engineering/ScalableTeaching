<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisualizationServer extends Model
{
    use HasFactory;

    protected $fillable = ['container_id', 'deadline'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
