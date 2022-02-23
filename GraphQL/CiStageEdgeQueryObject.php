<?php

namespace GraphQL\SchemaObject;

class CiStageEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiStageEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiStageEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiStageQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
