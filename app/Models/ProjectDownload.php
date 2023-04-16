<?php

namespace App\Models;

use App\Jobs\Project\DownloadProject;
use App\Models\Enums\DownloadState;
use Carbon\Carbon;
use Domain\Files\Directory;
use Domain\Files\File;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemException;
use Spatie\ShikiPhp\Shiki;
use Str;
use ZipArchive;

/**
 * @property int $project_id
 * @property-read Project $project
 * @property Carbon|null $downloaded_at
 * @property Carbon|null $expire_at
 * @property Carbon|null $queued_at
 * @property string $ref
 * @property-read bool $isDownloaded
 * @property-read string $state
 * @property string|null $location
 * @mixin Eloquent
 */
class ProjectDownload extends Model
{
    use HasFactory;

    protected $fillable = ['downloaded_at', 'location', 'expire_at', 'ref', 'queued_at'];

    protected $dates = ['downloaded_at'];

    protected $casts = [
        'expire_at' => 'datetime',
        'queued_at' => 'datetime'
    ];

    /**
     * @return BelongsTo<Project,ProjectDownload>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @param Builder<ProjectDownload> $query
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
        return Attribute::make(get: fn($value, $attributes) => $attributes['downloaded_at'] != null);
    }

    public function queue($minutesDelay = 0): void
    {
        DownloadProject::dispatch($this)->onQueue('downloads')->delay(now()->addMinutes($minutesDelay));
    }

    private function getZipFile(): ?string
    {
        try {
            if(!Storage::disk('local')->has($this->location)) {
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
        $root = new Directory(".");
        $path = Storage::path($this->location);
        //$baseFolder = opendir($path);

       /* while ($file =  readdir($baseFolder))
        {
            dd($file);
        }*/
        $files = (new Collection(Storage::allFiles($this->location)))->map(fn(string $file) => str($file)->remove($this->location)->ltrim('/')->toString());
        foreach($files as $fileName)
        {
            $path = explode('/', $fileName);
            $currentDir = $root;
            for($j = 0; $j < count($path); $j++) {
                $file = $path[$j];
                if($j + 1 < count($path)) {
                    $nextDirectory = $currentDir->getDirectory($file) ?? $currentDir->addDirectory(new Directory($file, $currentDir));
                    $currentDir = $nextDirectory;
                    continue;
                }
                if($file == "")
                    continue;
                $currentDir->addFile(new File($fileName, $currentDir));;
            }
        }
        return $root->nextDirectoryWithFiles();
    }

    /**
     * @param string $file
     * @return string
     */
    public function file(string $file): string
    {
        $filePath = str($this->location)->append('/', $file);
        return trim(Storage::get($filePath));
    }


    /**
     * @return Attribute<DownloadState,null>
     */
    public function state(): Attribute
    {
        return Attribute::make(get: function() {
            if($this->location == null)
                return DownloadState::Queued;
            return Storage::exists($this->location) ? DownloadState::OnDisk : DownloadState::Downloaded;
        });
    }
}
