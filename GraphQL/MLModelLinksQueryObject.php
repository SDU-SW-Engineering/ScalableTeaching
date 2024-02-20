<?php

namespace GraphQL\SchemaObject;

class MLModelLinksQueryObject extends QueryObject
{
    const OBJECT_NAME = "MLModelLinks";

    public function selectShowPath()
    {
        $this->selectField("showPath");

        return $this;
    }
}
