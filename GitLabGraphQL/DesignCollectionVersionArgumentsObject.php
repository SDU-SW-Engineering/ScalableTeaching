<?php

namespace GraphQL\SchemaObject;

class DesignCollectionVersionArgumentsObject extends ArgumentsObject
{
    protected $sha;
    protected $id;

    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
