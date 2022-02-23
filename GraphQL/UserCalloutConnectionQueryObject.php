<?php

namespace GraphQL\SchemaObject;

class UserCalloutConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserCalloutConnection";

    public function selectEdges(UserCalloutConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new UserCalloutEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(UserCalloutConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new UserCalloutQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(UserCalloutConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
