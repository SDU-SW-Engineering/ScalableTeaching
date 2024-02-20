<?php

namespace GraphQL\SchemaObject;

class ClusterAgentAuthorizationCiAccessQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentAuthorizationCiAccess";

    public function selectAgent(ClusterAgentAuthorizationCiAccessAgentArgumentsObject $argsObject = null)
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
