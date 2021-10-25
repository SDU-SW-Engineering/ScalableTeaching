<?php

namespace GraphQL\SchemaObject;

class NetworkPolicyQueryObject extends QueryObject
{
    const OBJECT_NAME = "NetworkPolicy";

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectEnvironments(NetworkPolicyEnvironmentsArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentConnectionQueryObject("environments");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFromAutoDevops()
    {
        $this->selectField("fromAutoDevops");

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

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectYaml()
    {
        $this->selectField("yaml");

        return $this;
    }
}
