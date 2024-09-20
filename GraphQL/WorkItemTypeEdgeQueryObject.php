<?php

namespace GraphQL\SchemaObject;

class WorkItemTypeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkItemTypeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(WorkItemTypeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new WorkItemTypeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
