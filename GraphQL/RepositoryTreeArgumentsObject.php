<?php

namespace GraphQL\SchemaObject;

class RepositoryTreeArgumentsObject extends ArgumentsObject
{
    protected $path;
    protected $recursive;
    protected $ref;

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function setRecursive($recursive)
    {
        $this->recursive = $recursive;

        return $this;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }
}
