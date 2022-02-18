<?php

namespace GraphQL\SchemaObject;

class EpicBoardEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicBoardEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EpicBoardEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EpicBoardQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
