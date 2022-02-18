<?php

namespace GraphQL\SchemaObject;

class VulnerableKubernetesResourceQueryObject extends QueryObject
{
    const OBJECT_NAME = "VulnerableKubernetesResource";

    public function selectAgent(VulnerableKubernetesResourceAgentArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentQueryObject("agent");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectClusterId()
    {
        $this->selectField("clusterId");

        return $this;
    }

    public function selectContainerName()
    {
        $this->selectField("containerName");

        return $this;
    }

    public function selectKind()
    {
        $this->selectField("kind");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectNamespace()
    {
        $this->selectField("namespace");

        return $this;
    }
}
