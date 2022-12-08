<?php

namespace Domain\SourceControl;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Directory
{
    public bool $fetched = false;
    /**
     * @var Collection<int,File>
     */
    public Collection $files;

    public function __construct(public string $path)
    {
        $this->files = new Collection();
    }

    public function graphQlSanitized() : Stringable
    {
        if ($this->path == "/")
            return Str::of($this->path);

        return Str::of($this->path)->trim("/");
    }
}
