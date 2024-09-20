<?php

namespace GraphQL\SchemaObject;

class EmailConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EmailConnection";

    public function selectEdges(EmailConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EmailEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(EmailConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new EmailQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EmailConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
