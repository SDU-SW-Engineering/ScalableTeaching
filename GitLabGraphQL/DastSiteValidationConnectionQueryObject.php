<?php

namespace GraphQL\SchemaObject;

class DastSiteValidationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastSiteValidationConnection";

    public function selectEdges(DastSiteValidationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DastSiteValidationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DastSiteValidationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DastSiteValidationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DastSiteValidationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
