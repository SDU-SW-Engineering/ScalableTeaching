<?php

namespace GraphQL\SchemaObject;

class DastProfileBranchQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastProfileBranch";

    public function selectExists()
    {
        $this->selectField("exists");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
