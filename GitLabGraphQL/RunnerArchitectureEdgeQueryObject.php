<?php

namespace GraphQL\SchemaObject;

class RunnerArchitectureEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "RunnerArchitectureEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(RunnerArchitectureEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new RunnerArchitectureQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
