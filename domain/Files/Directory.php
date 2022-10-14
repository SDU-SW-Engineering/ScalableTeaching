<?php

namespace Domain\Files;


class Directory implements \JsonSerializable, IsChangeable
{
    public string $path;
    public bool $changed = false;

    public ?Directory $parent = null;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function __construct(string $path, Directory $parent = null)
    {
        $paths = explode("/", $path);
        $this->path = $paths[count($paths) - 1];
        $this->parent = $parent;
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

    public function trim(string $what = null): Directory
    {
        if($what == null && $this->parent == null)
            $what = trim($this->path, '/');
        $this->path = str_replace($what, '/', $this->path);

        foreach($this->directories as $directory) {
            $directory->trim($what);
        }

        return $this;
    }

    public function traverse(\Closure $closure) : void
    {
        $closure($this);
        foreach($this->directories as $directory) {
            $directory->traverse($closure);
        }

        foreach($this->files as $file) {
            $closure($file);
        }
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
            'isRoot'      => $this->parent == null,
            'directories' => $this->directories,
            'files'       => $this->files,
            'changed'     => $this->changed
        ];
    }

    public function setChanged(bool $isChanged): void
    {
        $this->changed = $isChanged;
    }

    public function path() : string
    {
        $parts = [$this->path];

        $next = $this->parent;
        while($next != null) {
            if($next->path != "/")
                $parts[] = $next->path;
            $next = $next->parent;
        }

        return implode('/', array_reverse($parts));;
    }
}
