<?php

namespace GraphQL\SchemaObject;

class ScanEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScanEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ScanEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ScanQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
