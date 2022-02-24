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
        'value'    => Enums\GradeEnum::class,
        'selected' => 'boolean'
    ];

    // region relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function source()
    {
        $this->morphTo("source");
    }
    // endregion

    public static function booted()
    {
        static::creating(function(Grade $grade) {
            if($grade->selected == true) {
                Grade::where('user_id', $grade->user_id)
                    ->where('task_id', $grade->task_id)
                    ->update(['selected' => false]);
                return;
            }
            $userOverridden = Grade::where('user_id', $grade->user_id)
                ->where('task_id', $grade->task_id)
                ->where('source_type', User::class)->exists();
            $grade->selected = !$userOverridden;
            if($userOverridden)
                return;
            Grade::where('user_id', $grade->user_id)
                ->where('task_id', $grade->task_id)
                ->update(['selected' => false]);
        });
    }

    public function select()
    {
        Grade::where('user_id', $this->user_id)
            ->where('task_id', $this->task_id)
            ->update(['selected' => \DB::raw("id = $this->id")]);
    }
}

