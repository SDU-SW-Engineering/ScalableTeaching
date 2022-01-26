<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * @property int id
 * @property int task_id
 * @property int user_id
 * @property string source_type
 * @property int source_id
 * @property boolean selected
 * @property Enums\Grade value
 * @property ?string value_raw
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'source_id', 'source_type', 'value', 'value_raw', 'selected', 'task_id'];

    protected $casts = [
        'grade'    => Enums\Grade::class,
        'selected' => 'boolean'
    ];

    public function value()
    {
        return $this->entries()->first()->value;
    }

    public function source()
    {
        $this->morphTo("source");
    }

    public static function booted()
    {
        static::creating(function(Grade $grade) {
            if ($grade->selected == true)
            {
                Grade::where('user_id', $grade->user_id)
                    ->where('task_id', $grade->task_id)
                    ->update(['selected'=>false]);
                return;
            }
            $grade->selected = !Grade::where('user_id', $grade->user_id)
                ->where('task_id', $grade->task_id)
                ->where('selected', true)->exists();
        });
    }
}
