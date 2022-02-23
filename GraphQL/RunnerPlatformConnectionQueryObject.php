<?php

namespace GraphQL\SchemaObject;

class RunnerPlatformConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "RunnerPlatformConnection";

    public function selectEdges(RunnerPlatformConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new RunnerPlatformEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(RunnerPlatformConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new RunnerPlatformQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(RunnerPlatformConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
