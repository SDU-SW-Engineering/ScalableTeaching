<?php

namespace GraphQL\SchemaObject;

class CiRunnerManagerEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiRunnerManagerEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiRunnerManagerEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerManagerQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
