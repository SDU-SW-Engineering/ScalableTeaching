<?php

namespace GraphQL\SchemaObject;

class EpicListEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicListEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EpicListEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EpicListQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
