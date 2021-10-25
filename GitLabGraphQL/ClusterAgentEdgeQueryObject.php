<?php

namespace GraphQL\SchemaObject;

class ClusterAgentEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ClusterAgentEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
