<?php

namespace GraphQL\SchemaObject;

class ProjectIncidentManagementEscalationPolicyArgumentsObject extends ArgumentsObject
{
    protected $name;
    protected $id;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
