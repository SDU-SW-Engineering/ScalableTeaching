<?php

namespace GraphQL\SchemaObject;

class ClusterAgentActivityEventEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentActivityEventEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ClusterAgentActivityEventEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentActivityEventQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
