<?php

namespace GraphQL\SchemaObject;

class ClusterAgentTokenQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentToken";

    public function selectClusterAgent(ClusterAgentTokenClusterAgentArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentQueryObject("clusterAgent");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectCreatedByUser(ClusterAgentTokenCreatedByUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("createdByUser");
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

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLastUsedAt()
    {
        $this->selectField("lastUsedAt");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
