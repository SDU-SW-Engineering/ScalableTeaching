<?php

namespace Domain\Files;

use Illuminate\Contracts\Support\Arrayable;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Internal\TentativeType;

class HighlightedLine implements Arrayable, \JsonSerializable
{
    public function __construct(public int $number, public string $line)
    {
    }


    #[ArrayShape(['number' => "int", 'line' => "string"])]
    public function toArray(): array
    {
        return [
            'number' => $this->number,
            'line'   => $this->line
        ];
    }

    #[ArrayShape(['number' => "int", 'line' => "string"])]
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
