<?php

namespace GraphQL\SchemaObject;

class ClusterAgentAuthorizationCiAccessEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentAuthorizationCiAccessEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ClusterAgentAuthorizationCiAccessEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentAuthorizationCiAccessQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
