<?php

namespace GraphQL\SchemaObject;

class MilestoneQueryObject extends QueryObject
{
    const OBJECT_NAME = "Milestone";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDueDate()
    {
        $this->selectField("dueDate");

        return $this;
    }

    public function selectExpired()
    {
        $this->selectField("expired");

        return $this;
    }

    public function selectGroupMilestone()
    {
        $this->selectField("groupMilestone");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIid()
    {
        $this->selectField("iid");

        return $this;
    }

    public function selectProjectMilestone()
    {
        $this->selectField("projectMilestone");

        return $this;
    }

    public function selectReleases(MilestoneReleasesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseConnectionQueryObject("releases");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStartDate()
    {
        $this->selectField("startDate");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }

    public function selectStats(MilestoneStatsArgumentsObject $argsObject = null)
    {
        $object = new MilestoneStatsQueryObject("stats");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubgroupMilestone()
    {
        $this->selectField("subgroupMilestone");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }
}
