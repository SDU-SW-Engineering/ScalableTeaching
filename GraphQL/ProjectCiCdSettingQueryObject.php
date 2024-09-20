<?php

namespace GraphQL\SchemaObject;

class ProjectCiCdSettingQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectCiCdSetting";

    public function selectInboundJobTokenScopeEnabled()
    {
        $this->selectField("inboundJobTokenScopeEnabled");

        return $this;
    }

    public function selectJobTokenScopeEnabled()
    {
        $this->selectField("jobTokenScopeEnabled");

        return $this;
    }

    public function selectKeepLatestArtifact()
    {
        $this->selectField("keepLatestArtifact");

        return $this;
    }

    public function selectMergePipelinesEnabled()
    {
        $this->selectField("mergePipelinesEnabled");

        return $this;
    }

    public function selectProject(ProjectCiCdSettingProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
