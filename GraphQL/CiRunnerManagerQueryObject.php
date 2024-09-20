<?php

namespace GraphQL\SchemaObject;

class CiRunnerManagerQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiRunnerManager";

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

    public function selectExecutorName()
    {
        $this->selectField("executorName");

        return $this;
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

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.3.
     */
    public function selectJobExecutionStatus()
    {
        $this->selectField("jobExecutionStatus");

        return $this;
    }

    public function selectPlatformName()
    {
        $this->selectField("platformName");

        return $this;
    }

    public function selectRevision()
    {
        $this->selectField("revision");

        return $this;
    }

    public function selectRunner(CiRunnerManagerRunnerArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerQueryObject("runner");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectSystemId()
    {
        $this->selectField("systemId");

        return $this;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
