<?php

namespace GraphQL\SchemaObject;

class ScannedResourceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScannedResourceConnection";

    public function selectEdges(ScannedResourceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ScannedResourceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ScannedResourceConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ScannedResourceQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ScannedResourceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
