<?php

namespace GraphQL\SchemaObject;

class ProjectEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ProjectEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
