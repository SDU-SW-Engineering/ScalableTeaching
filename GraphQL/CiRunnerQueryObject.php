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

    /**
     * @deprecated Use field in `manager` object instead. Deprecated in 16.2.
     */
    public function selectArchitectureName()
    {
        $this->selectField("architectureName");

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

    public function selectCreatedBy(CiRunnerCreatedByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("createdBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.9.
     */
    public function selectEphemeralAuthenticationToken()
    {
        $this->selectField("ephemeralAuthenticationToken");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.11.
     */
    public function selectEphemeralRegisterUrl()
    {
        $this->selectField("ephemeralRegisterUrl");

        return $this;
    }

    /**
     * @deprecated Use field in `manager` object instead. Deprecated in 16.2.
     */
    public function selectExecutorName()
    {
        $this->selectField("executorName");

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

    /**
     * @deprecated Use field in `manager` object instead. Deprecated in 16.2.
     */
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.7.
     */
    public function selectJobExecutionStatus()
    {
        $this->selectField("jobExecutionStatus");

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

    public function selectMaintenanceNote()
    {
        $this->selectField("maintenanceNote");

        return $this;
    }

    public function selectMaintenanceNoteHtml()
    {
        $this->selectField("maintenanceNoteHtml");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.10.
     */
    public function selectManagers(CiRunnerManagersArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerManagerConnectionQueryObject("managers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMaximumTimeout()
    {
        $this->selectField("maximumTimeout");

        return $this;
    }

    public function selectOwnerProject(CiRunnerOwnerProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("ownerProject");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPaused()
    {
        $this->selectField("paused");

        return $this;
    }

    /**
     * @deprecated Use field in `manager` object instead. Deprecated in 16.2.
     */
    public function selectPlatformName()
    {
        $this->selectField("platformName");

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

    public function selectRegisterAdminUrl()
    {
        $this->selectField("registerAdminUrl");

        return $this;
    }

    /**
     * @deprecated Use field in `manager` object instead. Deprecated in 16.2.
     */
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

    /**
     * @deprecated Use field in `manager` object instead. Deprecated in 16.2.
     */
    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
