<?php

namespace GraphQL\SchemaObject;

class DesignCollectionVersionArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $sha;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }
}
