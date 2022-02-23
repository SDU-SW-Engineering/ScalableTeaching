<?php

namespace GraphQL\SchemaObject;

class DesignVersionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignVersionConnection";

    public function selectEdges(DesignVersionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DesignVersionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DesignVersionConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DesignVersionQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DesignVersionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
