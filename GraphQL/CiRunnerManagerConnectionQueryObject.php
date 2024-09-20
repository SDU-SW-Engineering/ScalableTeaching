<?php

namespace GraphQL\SchemaObject;

class CiRunnerManagerConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiRunnerManagerConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(CiRunnerManagerConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerManagerEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiRunnerManagerConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerManagerQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiRunnerManagerConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
