<?php

namespace GraphQL\SchemaObject;

class DescriptionVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DescriptionVersion";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}
