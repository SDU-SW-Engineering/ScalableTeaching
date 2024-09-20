<?php

namespace GraphQL\SchemaObject;

class ProjectConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(ProjectConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ProjectEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ProjectConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ProjectConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
