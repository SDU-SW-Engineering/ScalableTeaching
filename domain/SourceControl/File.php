<?php

namespace Domain\SourceControl;

use Illuminate\Support\Stringable;
use Str;

class File
{
    private string $path;
    private string $name;
    private string $sha;

    /**
     * @param string $path
     * @param string $name
     * @param string $sha
     */
    public function __construct(string $path, string $name, string $sha)
    {
        $this->path = $path;
        $this->name = $name;
        $this->sha = $sha;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSha(): string
    {
        return $this->sha;
    }

    /**
     * @param string $sha
     */
    public function setSha(string $sha): void
    {
        $this->sha = $sha;
    }

    public function fullPath() : Stringable
    {
        return Str::of($this->path)->append(Str::of($this->path)->endsWith("/") ? "" : "/", $this->name);
    }
}
