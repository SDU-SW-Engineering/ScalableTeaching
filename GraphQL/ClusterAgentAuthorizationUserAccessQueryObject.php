<?php

namespace GraphQL\SchemaObject;

class ClusterAgentAuthorizationUserAccessQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentAuthorizationUserAccess";

    public function selectAgent(ClusterAgentAuthorizationUserAccessAgentArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentQueryObject("agent");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectConfig()
    {
        $this->selectField("config");

        return $this;
    }
}
