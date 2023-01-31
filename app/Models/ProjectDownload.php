<?php

namespace App\Models;

use App\Jobs\Project\DownloadProject;
use Carbon\Carbon;
use Domain\Files\Directory;
use Domain\Files\File;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemException;
use Str;
use ZipArchive;

/**
 * @property int $project_id
 * @property-read Project $project
 * @property Carbon|null $downloaded_at
 * @property string $ref
 * @property-read bool $isDownloaded
 * @property string|null $location
 *
 * @mixin Eloquent
 */
class ProjectDownload extends Model
{
    use HasFactory;

    protected $fillable = ['downloaded_at', 'location', 'expire_at', 'ref'];

    protected $dates = ['downloaded_at'];

    /**
     * @return BelongsTo<Project,ProjectDownload>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @param  Builder<ProjectDownload>  $query
     * @return Builder<ProjectDownload>
     */
    public function scopeQueued(Builder $query): Builder
    {
        return $query->whereNull('downloaded_at');
    }

    /**
     * @return Attribute<bool,null>
     */
    public function isDownloaded(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => $attributes['downloaded_at'] != null);
    }

    public function queue(): void
    {
        DownloadProject::dispatch($this)->onQueue('downloads');
    }

    private function getZipFile(): ?string
    {
        try {
            if (! Storage::disk('local')->has($this->location)) {
                $this->location = null;
                $this->downloaded_at = null;
                $this->save();
                $this->queue();

                return null;
            }

            return Storage::disk('local')->path($this->location);
        } catch(FilesystemException $exception) {
            return null;
        }
    }

    public function fileTree(): Directory
    {
        $file = $this->getZipFile();
        $zip = new ZipArchive();
        $zip->open($file, ZipArchive::RDONLY);
        $root = new Directory('.');
        $remove = Str::of($zip->getNameIndex(0))->trim('/');
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $fileName = $zip->getNameIndex($i);
            $path = explode('/', $fileName);
            $currentDir = $root;
            for ($j = 0; $j < count($path); $j++) {
                $file = $path[$j];
                if ($j + 1 < count($path)) {
                    $nextDirectory = $currentDir->getDirectory($file) ?? $currentDir->addDirectory(new Directory($file, $i == 0 ? null : $currentDir));
                    $currentDir = $nextDirectory;

                    continue;
                }
                if ($file == '') {
                    continue;
                }
                $currentDir->addFile(new File($fileName, $currentDir));
            }
        }

        return $root->nextDirectoryWithFiles();
    }

    /**
     * @param  string  $file
     * @return string
     */
    public function file(string $file): string
    {
        $fileOnDisk = $this->getZipFile();
        $zip = new ZipArchive();
        $zip->open($fileOnDisk);
        $fp = $zip->getStream($file);
        $contents = null;
        while (! feof($fp)) {
            $contents .= fread($fp, 2);
        }
        fclose($fp);

        return trim($contents);
    }
}
