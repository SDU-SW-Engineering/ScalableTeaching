<?php

namespace GraphQL\SchemaObject;

class PipelineSchedulePermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineSchedulePermissions";

    public function selectAdminPipelineSchedule()
    {
        $this->selectField("adminPipelineSchedule");

        return $this;
    }

    public function selectPlayPipelineSchedule()
    {
        $this->selectField("playPipelineSchedule");

        return $this;
    }

    /**
     * @deprecated Use admin_pipeline_schedule permission to determine if the user can take ownership of a pipeline schedule. Deprecated in 15.9.
     */
    public function selectTakeOwnershipPipelineSchedule()
    {
        $this->selectField("takeOwnershipPipelineSchedule");

        return $this;
    }

    public function selectUpdatePipelineSchedule()
    {
        $this->selectField("updatePipelineSchedule");

        return $this;
    }
}
