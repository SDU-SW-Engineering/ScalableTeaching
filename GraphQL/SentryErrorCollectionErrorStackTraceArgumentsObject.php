<?php

namespace GraphQL\SchemaObject;

class SentryErrorCollectionErrorStackTraceArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
