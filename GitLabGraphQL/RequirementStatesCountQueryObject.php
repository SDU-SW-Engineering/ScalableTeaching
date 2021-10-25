<?php

namespace GraphQL\SchemaObject;

class RequirementStatesCountQueryObject extends QueryObject
{
    const OBJECT_NAME = "RequirementStatesCount";

    public function selectArchived()
    {
        $this->selectField("archived");

        return $this;
    }

    public function selectOpened()
    {
        $this->selectField("opened");

        return $this;
    }
}
