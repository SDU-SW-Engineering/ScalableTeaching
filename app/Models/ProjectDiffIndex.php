<?php

namespace App\Models;

use App\Models\Enums\ProjectDiffIndexStatus;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $project_id
 * @property ProjectDiffIndexStatus $status;
 * @property string $from;
 * @property string $to;
 * @property array{file: string, status: string, lines: int, proportion: string} $changes
 * @property string|null $message;
 * @property Carbon $last_try
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @mixin Eloquent
 */
class ProjectDiffIndex extends Model
{
    use HasFactory;

    protected $casts = [
        'changes' => 'array',
        'status' => ProjectDiffIndexStatus::class,
    ];
}
