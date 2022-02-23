<?php

namespace GraphQL\SchemaObject;

class ProjectIncidentManagementTimelineEventArgumentsObject extends ArgumentsObject
{
    protected $incidentId;
    protected $id;

    public function setIncidentId($incidentId)
    {
        $this->incidentId = $incidentId;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
