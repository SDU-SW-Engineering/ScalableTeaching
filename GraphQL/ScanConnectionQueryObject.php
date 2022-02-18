<?php

namespace GraphQL\SchemaObject;

class ScanConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ScanConnection";

    public function selectEdges(ScanConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ScanEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ScanConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ScanQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ScanConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
