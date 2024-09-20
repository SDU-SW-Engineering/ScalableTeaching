<?php

namespace GraphQL\SchemaObject;

class WorkItemEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkItemEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(WorkItemEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new WorkItemQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
