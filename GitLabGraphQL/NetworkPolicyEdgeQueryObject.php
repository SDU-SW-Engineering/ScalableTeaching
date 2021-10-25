<?php

namespace GraphQL\SchemaObject;

class NetworkPolicyEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NetworkPolicyEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NetworkPolicyEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NetworkPolicyQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
