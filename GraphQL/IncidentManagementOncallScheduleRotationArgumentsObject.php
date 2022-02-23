<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallScheduleRotationArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
