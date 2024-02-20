<?php

namespace GraphQL\SchemaObject;

class ProjectPlanLimitsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectPlanLimits";

    public function selectCiPipelineSchedules()
    {
        $this->selectField("ciPipelineSchedules");

        return $this;
    }
}
