<?php

namespace GraphQL\SchemaObject;

class RepositoryBlobBlameArgumentsObject extends ArgumentsObject
{
    protected $fromLine;
    protected $toLine;

    public function setFromLine($fromLine)
    {
        $this->fromLine = $fromLine;

        return $this;
    }

    public function setToLine($toLine)
    {
        $this->toLine = $toLine;

        return $this;
    }
}
