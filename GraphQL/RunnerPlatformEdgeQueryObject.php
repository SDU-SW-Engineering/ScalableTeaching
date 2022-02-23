<?php

namespace GraphQL\SchemaObject;

class RunnerPlatformEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "RunnerPlatformEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(RunnerPlatformEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new RunnerPlatformQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
