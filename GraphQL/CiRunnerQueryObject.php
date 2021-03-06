<?php

namespace GraphQL\SchemaObject;

class CiRunnerQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiRunner";

    public function selectAccessLevel()
    {
        $this->selectField("accessLevel");

        return $this;
    }

    /**
     * @deprecated Use paused. Deprecated in 14.8.
     */
    public function selectActive()
    {
        $this->selectField("active");

        return $this;
    }

    public function selectAdminUrl()
    {
        $this->selectField("adminUrl");

        return $this;
    }

    public function selectContactedAt()
    {
        $this->selectField("contactedAt");

        return $this;
    }

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

    public function selectEditAdminUrl()
    {
        $this->selectField("editAdminUrl");

        return $this;
    }

    public function selectGroups(CiRunnerGroupsArgumentsObject $argsObject = null)
    {
        $object = new GroupConnectionQueryObject("groups");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIpAddress()
    {
        $this->selectField("ipAddress");

        return $this;
    }

    public function selectJobCount()
    {
        $this->selectField("jobCount");

        return $this;
    }

    public function selectJobs(CiRunnerJobsArgumentsObject $argsObject = null)
    {
        $object = new CiJobConnectionQueryObject("jobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLocked()
    {
        $this->selectField("locked");

        return $this;
    }

    public function selectMaximumTimeout()
    {
        $this->selectField("maximumTimeout");

        return $this;
    }

    public function selectPaused()
    {
        $this->selectField("paused");

        return $this;
    }

    public function selectPrivateProjectsMinutesCostFactor()
    {
        $this->selectField("privateProjectsMinutesCostFactor");

        return $this;
    }

    public function selectProjectCount()
    {
        $this->selectField("projectCount");

        return $this;
    }

    public function selectProjects(CiRunnerProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPublicProjectsMinutesCostFactor()
    {
        $this->selectField("publicProjectsMinutesCostFactor");

        return $this;
    }

    public function selectRevision()
    {
        $this->selectField("revision");

        return $this;
    }

    public function selectRunUntagged()
    {
        $this->selectField("runUntagged");

        return $this;
    }

    public function selectRunnerType()
    {
        $this->selectField("runnerType");

        return $this;
    }

    public function selectShortSha()
    {
        $this->selectField("shortSha");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTagList()
    {
        $this->selectField("tagList");

        return $this;
    }

    public function selectTokenExpiresAt()
    {
        $this->selectField("tokenExpiresAt");

        return $this;
    }

    public function selectUserPermissions(CiRunnerUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new RunnerPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
