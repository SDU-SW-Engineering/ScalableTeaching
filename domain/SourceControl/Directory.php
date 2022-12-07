<?php

namespace Domain\SourceControl;

use Illuminate\Support\Collection;

class Directory
{
    public bool $fetched = false;
    /**
     * @var Collection<File>
     */
    public Collection $files;

    public function __construct(public $path)
    {
        $this->files = new Collection();
    }
}
