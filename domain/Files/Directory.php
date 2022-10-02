<?php

namespace Domain\Files;


class Directory implements \JsonSerializable
{
    private string $path;
    private bool $isRoot = false;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function __construct(string $path, bool $isRoot = false)
    {
        $paths = explode("/", $path);
        $this->path = $paths[count($paths) - 1];
        $this->isRoot = $isRoot;
    }

    /**
     * @var File[]
     */
    private array $files = [];

    /**
     * @var Directory[]
     */
    private array $directories = [];

    public function addDirectory(Directory $directory): Directory
    {
        $this->directories[] = $directory;

        return $directory;
    }

    public function addFile(File $file): void
    {
        $this->files[] = $file;
    }

    public function getDirectory(string $name): ?Directory
    {
        foreach($this->directories as $directory) {
            if($directory->getPath() == $name)
                return $directory;
        }

        return null;
    }

    public function nextDirectoryWithFiles(): ?Directory
    {
        if(!$this->isPointless())
            return $this;

        foreach($this->directories as $directory) {
            if(!$directory->isPointless())
                return $directory;
        }

        return null;
    }

    public function trim(string $what = null) : Directory
    {
        if($what == null && $this->isRoot)
            $what = trim($this->path, '/');
        $this->path = str_replace($what, '/', $this->path);

        foreach($this->directories as $directory) {
            $directory->trim($what);
        }

        return $this;
    }

    /**
     * @return bool A directory that contains nothing but one folder
     */
    public function isPointless(): bool
    {
        return count($this->directories) == 1 && count($this->files) == 0;
    }

    public function jsonSerialize(): array
    {
        return [
            'name'        => $this->path,
            'isRoot'      => $this->isRoot,
            'directories' => $this->directories,
            'files'       => $this->files
        ];
    }
}
