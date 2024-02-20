<?php

namespace GraphQL\SchemaObject;

class GroupWorkItemArgumentsObject extends ArgumentsObject
{
    protected $iid;

    public function setIid($iid)
    {
        $this->iid = $iid;

        return $this;
    }
}
