<?php

namespace GraphQL\SchemaObject;

class ReleaseSourceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseSourceConnection";

    public function selectEdges(ReleaseSourceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseSourceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ReleaseSourceConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseSourceQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ReleaseSourceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
