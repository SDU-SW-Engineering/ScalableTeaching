<?php

namespace GraphQL\SchemaObject;

class ConnectedAgentEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ConnectedAgentEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ConnectedAgentEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ConnectedAgentQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
