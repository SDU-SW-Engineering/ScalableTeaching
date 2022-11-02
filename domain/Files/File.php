<?php

namespace Domain\Files;

use JsonSerializable;

class File implements JsonSerializable, IsChangeable
{
    public string $name;

    public bool $changed = false;

    public Directory $directory;

    public function __construct(public string $fullPath, Directory $directory)
    {
        $paths = explode('/', $this->fullPath);
        $this->name = $paths[count($paths) - 1];
        $this->directory = $directory;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'full' => $this->fullPath,
            'changed' => $this->changed,
        ];
    }

    public function setChanged(bool $isChanged): void
    {
        $this->changed = $isChanged;
    }

    public function path(): string
    {
        $parts = [$this->name];

        $next = $this->directory;
        while ($next != null) {
            if ($next->path !== '/') {
                $parts[] = $next->path;
            }
            /** @var Directory $next */
            $next = $next->parent;
        }

        return implode('/', array_reverse($parts));
    }
}
