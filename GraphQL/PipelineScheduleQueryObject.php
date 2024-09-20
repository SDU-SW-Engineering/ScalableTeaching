<?php

namespace GraphQL\SchemaObject;

class PipelineScheduleQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineSchedule";

    public function selectActive()
    {
        $this->selectField("active");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectCron()
    {
        $this->selectField("cron");

        return $this;
    }

    public function selectCronTimezone()
    {
        $this->selectField("cronTimezone");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEditPath()
    {
        $this->selectField("editPath");

        return $this;
    }

    public function selectForTag()
    {
        $this->selectField("forTag");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLastPipeline(PipelineScheduleLastPipelineArgumentsObject $argsObject = null)
    {
        $object = new PipelineQueryObject("lastPipeline");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNextRunAt()
    {
        $this->selectField("nextRunAt");

        return $this;
    }

    public function selectOwner(PipelineScheduleOwnerArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("owner");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(PipelineScheduleProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRealNextRun()
    {
        $this->selectField("realNextRun");

        return $this;
    }

    public function selectRef()
    {
        $this->selectField("ref");

        return $this;
    }

    public function selectRefForDisplay()
    {
        $this->selectField("refForDisplay");

        return $this;
    }

    public function selectRefPath()
    {
        $this->selectField("refPath");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUserPermissions(PipelineScheduleUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new PipelineSchedulePermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVariables(PipelineScheduleVariablesArgumentsObject $argsObject = null)
    {
        $object = new PipelineScheduleVariableConnectionQueryObject("variables");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
