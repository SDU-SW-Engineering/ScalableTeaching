<?php

namespace App\Models;

use Badcow\PhraseGenerator\PhraseGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class GradeDelegation extends Model
{
    protected $table = 'grade_delegations';
    protected $fillable = ['project_id'];

    public static function booted()
    {
        static::creating(function (GradeDelegation $gradeDelegation)
        {
            do
            {
                $pseudonym = PhraseGenerator::generate(2);

            } while(static::where('pseudonym', $pseudonym)->where('user_id', $gradeDelegation->user_id)->exists());
            $gradeDelegation->pseudonym = $pseudonym;
        });
    }
}
