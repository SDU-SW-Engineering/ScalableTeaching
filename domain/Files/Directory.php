<?php

namespace Domain\Files;


class Directory implements \JsonSerializable
{
    private string $path;

    private string $fullPath;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function __construct(string $path)
    {
        $paths = explode("/", $path);
        $this->path = $paths[count($paths) -1];
        //$this->fullPath = $path;
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

    public function addFile(File $file)
    {
        $this->files[] = $file;
    }

    public function getDirectory(string $name)
    {
        foreach($this->directories as $directory)
        {
            if ($directory->getPath() == $name)
                return $directory;
        }

        return null;
    }

    public function nextDirectoryWithFiles() : ?Directory
    {
        if (!$this->isPointless())
            return $this;

        foreach($this->directories as $directory)
        {
            if (!$directory->isPointless())
                return $directory;
        }

        return null;
    }

    /**
     * @return bool A directory that contains nothing but one folder
     */
    public function isPointless() : bool
    {
        return count($this->directories) == 1 && count($this->files) == 0;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->path,
            'directories' => $this->directories,
            'files' => $this->files
        ];
    }
}
