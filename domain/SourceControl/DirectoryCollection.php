<?php

namespace Domain\SourceControl;

use Illuminate\Support\Collection;

class DirectoryCollection
{
    /** @var Collection<Directory> */
    public Collection $directories;

    public function __construct(Collection $directories)
    {
        $this->directories = new Collection();
        foreach($directories as $directory)
            $this->add($directory);
    }

    public function add(Directory $directory): void
    {
        $this->directories[$directory->path] = $directory;
    }

    public function getFile(string $path) : ?File
    {
        $path = trim($path, "/");
        $file = pathinfo($path);
        if ($file['dirname'] == '.')
            $file['dirname'] = "/";
        if (!$this->directories->has($file['dirname']))
            return null;

        /** @var Directory $directory */
        $directory = $this->directories->get($file['dirname']);
        return $directory->files->firstWhere(fn(File $f) => $f->getName() == $file['basename']);
    }
}
