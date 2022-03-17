<?php

namespace Domain\Files;

use JsonSerializable;

class File implements JsonSerializable
{
    private string $name;

    public function __construct(private string $fullPath)
    {
        $paths = explode("/", $this->fullPath);
        $this->name = $paths[count($paths) -1];
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'full' => $this->fullPath
        ];
    }
}
