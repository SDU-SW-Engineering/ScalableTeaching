<?php

namespace GraphQL\SchemaObject;

class TopicEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TopicEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TopicEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TopicQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
