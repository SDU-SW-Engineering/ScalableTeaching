<?php

namespace GraphQL\SchemaObject;

class ClusterAgentActivityEventQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentActivityEvent";

    public function selectAgentToken(ClusterAgentActivityEventAgentTokenArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentTokenQueryObject("agentToken");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKind()
    {
        $this->selectField("kind");

        return $this;
    }

    public function selectLevel()
    {
        $this->selectField("level");

        return $this;
    }

    public function selectRecordedAt()
    {
        $this->selectField("recordedAt");

        return $this;
    }

    public function selectUser(ClusterAgentActivityEventUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
