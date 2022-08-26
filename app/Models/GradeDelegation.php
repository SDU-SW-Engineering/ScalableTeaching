<?php

namespace App\Models;

use Badcow\PhraseGenerator\PhraseGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class GradeDelegation extends Model
{
    use HasFactory;

    protected $table = 'grade_delegations';
    protected $fillable = ['project_id', 'pseudonym'];

    public static function booted()
    {
        static::creating(function (GradeDelegation $gradeDelegation) {
            do
            {
                $pseudonym = PhraseGenerator::generate(2);

            } while(static::where('pseudonym', $pseudonym)->where('user_id', $gradeDelegation->user_id)->exists());
            $gradeDelegation->pseudonym = $pseudonym;
        });
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
