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
    public static function fromFiles(Collection $files): DirectoryCollection
    {
        return new DirectoryCollection((new Collection($files))->map(function($file) {
            $dirName = pathinfo($file)['dirname'];
            if ($dirName == ".")
                $dirName = "/";
            return new Directory($dirName);
        }));
    }

    public function getFile(string $path): ?File
    {
        $path = trim($path, "/");
        $file = pathinfo($path);
        if($file['dirname'] == '.')
            $file['dirname'] = "/";
        $directory = $this->directories->firstWhere(fn(Directory $directory, string $keyPath) => ($keyPath == "/" ? "/" : trim($keyPath, '/')) == $file['dirname']);
        if($directory == null)
            return null;

        /** @var Directory $directory */
        return $directory->files->firstWhere(fn(File $f) => $f->getName() == $file['basename']);
    }

    /**
     * @return Collection<int,File>
     */
    public function files(): Collection
    {
        /** @var Collection<int,File> $files */
        $files = new Collection();
        $this->directories->each(function(Directory $directory) use ($files) {
            foreach($directory->files as $file) {
                $files[] = $file;
            }
        });
        return $files;
    }
}
