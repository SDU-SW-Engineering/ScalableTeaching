<?php

namespace GraphQL\SchemaObject;

class PathLockConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PathLockConnection";

    public function selectEdges(PathLockConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PathLockEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PathLockConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PathLockQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PathLockConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
