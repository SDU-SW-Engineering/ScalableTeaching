<?php

namespace GraphQL\SchemaObject;

class RootAbuseReportArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
