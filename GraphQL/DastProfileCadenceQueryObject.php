<?php

namespace GraphQL\SchemaObject;

class DastProfileCadenceQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastProfileCadence";

    public function selectDuration()
    {
        $this->selectField("duration");

        return $this;
    }

    public function selectUnit()
    {
        $this->selectField("unit");

        return $this;
    }
}
