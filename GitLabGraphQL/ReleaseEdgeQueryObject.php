<?php

namespace GraphQL\SchemaObject;

class ReleaseEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ReleaseEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ReleaseQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
