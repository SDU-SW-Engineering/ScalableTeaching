<?php

namespace GraphQL\SchemaObject;

class CiConfigStageEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiConfigStageEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiConfigStageEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiConfigStageQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
