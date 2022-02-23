<?php

namespace GraphQL\SchemaObject;

class DastProfileEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastProfileEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DastProfileEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DastProfileQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
