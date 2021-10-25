<?php

namespace GraphQL\SchemaObject;

class CiConfigJobRestrictionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigJobRestriction";

    public function selectRefs()
    {
        $this->selectField("refs");

        return $this;
    }
}
