<?php

namespace GraphQL\SchemaObject;

class PathLockEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PathLockEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PathLockEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PathLockQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
