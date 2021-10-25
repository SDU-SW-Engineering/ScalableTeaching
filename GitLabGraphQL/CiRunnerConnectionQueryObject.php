<?php

namespace GraphQL\SchemaObject;

class CiRunnerConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiRunnerConnection";

    public function selectEdges(CiRunnerConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiRunnerConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiRunnerConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
