<?php

namespace GraphQL\SchemaObject;

class UserCoreEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserCoreEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(UserCoreEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
