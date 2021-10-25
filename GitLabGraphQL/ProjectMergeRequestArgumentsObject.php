<?php

namespace GraphQL\SchemaObject;

class ProjectMergeRequestArgumentsObject extends ArgumentsObject
{
    protected $iid;

    public function setIid($iid)
    {
        $this->iid = $iid;

        return $this;
    }
}
