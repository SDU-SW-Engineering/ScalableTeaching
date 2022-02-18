<?php

namespace GraphQL\SchemaObject;

class UserCalloutEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserCalloutEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(UserCalloutEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new UserCalloutQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
