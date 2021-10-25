<?php

namespace GraphQL\SchemaObject;

class RunnerArchitectureConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "RunnerArchitectureConnection";

    public function selectEdges(RunnerArchitectureConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new RunnerArchitectureEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(RunnerArchitectureConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new RunnerArchitectureQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(RunnerArchitectureConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
