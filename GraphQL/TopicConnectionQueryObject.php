<?php

namespace GraphQL\SchemaObject;

class TopicConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TopicConnection";

    public function selectEdges(TopicConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TopicEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TopicConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TopicQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TopicConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
