<?php

namespace GraphQL\SchemaObject;

class ClusterAgentTokenEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentTokenEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ClusterAgentTokenEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentTokenQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
