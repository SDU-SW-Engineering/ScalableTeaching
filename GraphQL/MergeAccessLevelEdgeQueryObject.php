<?php

namespace GraphQL\SchemaObject;

class MergeAccessLevelEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeAccessLevelEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MergeAccessLevelEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MergeAccessLevelQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
