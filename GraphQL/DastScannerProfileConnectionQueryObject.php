<?php

namespace GraphQL\SchemaObject;

class DastScannerProfileConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastScannerProfileConnection";

    public function selectEdges(DastScannerProfileConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DastScannerProfileEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DastScannerProfileConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DastScannerProfileQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DastScannerProfileConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
