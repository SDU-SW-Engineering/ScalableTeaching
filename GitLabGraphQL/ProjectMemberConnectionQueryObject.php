<?php

namespace GraphQL\SchemaObject;

class ProjectMemberConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectMemberConnection";

    public function selectEdges(ProjectMemberConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ProjectMemberEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ProjectMemberConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ProjectMemberQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ProjectMemberConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
