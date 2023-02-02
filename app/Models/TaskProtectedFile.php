<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property string $path
 * @property Collection<string> $sha_values
 */
class TaskProtectedFile extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'sha_values'];

    protected $casts = ['sha_values' => 'collection'];

    public function getBaseNameAttribute(): string
    {
        return pathinfo($this->path)['basename'];
    }

    public function getDirectoryAttribute(): string
    {
        $directory = pathinfo($this->path)['dirname'];
        if ($directory == '\\') {
            $directory = '/';
        }

        return $directory;
    }
}
