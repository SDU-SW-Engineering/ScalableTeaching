<?php

namespace GraphQL\SchemaObject;

class DastSiteProfileConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastSiteProfileConnection";

    public function selectEdges(DastSiteProfileConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DastSiteProfileEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DastSiteProfileConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DastSiteProfileQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DastSiteProfileConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
