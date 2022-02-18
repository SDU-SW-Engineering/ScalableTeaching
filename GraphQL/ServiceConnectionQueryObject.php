<?php

namespace GraphQL\SchemaObject;

class ServiceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ServiceConnection";

    public function selectEdges(ServiceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ServiceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ServiceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
