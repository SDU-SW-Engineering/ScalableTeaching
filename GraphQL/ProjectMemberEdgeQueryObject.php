<?php

namespace GraphQL\SchemaObject;

class ProjectMemberEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectMemberEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ProjectMemberEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ProjectMemberQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
