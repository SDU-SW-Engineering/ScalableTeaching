<?php

namespace GraphQL\SchemaObject;

class RootUserArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $username;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
}
