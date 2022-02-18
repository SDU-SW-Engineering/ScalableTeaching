<?php

namespace GraphQL\SchemaObject;

class ReleaseSourceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseSourceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ReleaseSourceEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ReleaseSourceQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
