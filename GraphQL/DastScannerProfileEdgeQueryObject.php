<?php

namespace GraphQL\SchemaObject;

class DastScannerProfileEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastScannerProfileEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DastScannerProfileEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DastScannerProfileQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
