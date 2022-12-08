<?php

namespace Domain\SourceControl;

use Illuminate\Support\Collection;

class DirectoryCollection
{
    /** @var Collection<string,Directory> */
    public Collection $directories;

    /**
     * @param Collection<int,Directory> $directories
     */
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

    /**
     * @param Collection<int,string> $files
     * @return DirectoryCollection
     */
    public static function fromFiles(Collection $files) : DirectoryCollection {
        return new DirectoryCollection((new Collection($files))->map(function($file) {
            return new Directory(pathinfo($file)['dirname']);
        }));
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

    /**
     * @return Collection<int,File>
     */
    public function files() : Collection
    {
        /** @var Collection<int,File> $files */
        $files = new Collection();
        $this->directories->each(function(Directory $directory) use ($files) {
            foreach ($directory->files as $file) {
                $files[] = $file;
            }
        });
        return $files;
    }
}
