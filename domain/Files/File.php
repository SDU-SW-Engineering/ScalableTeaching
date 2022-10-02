<?php

namespace Domain\Files;

use JsonSerializable;

class File implements JsonSerializable
{
    public string $name;

    public function __construct(public string $fullPath)
    {
        $paths = explode("/", $this->fullPath);
        $this->name = $paths[count($paths) -1];
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'full' => $this->fullPath
        ];
    }
}
