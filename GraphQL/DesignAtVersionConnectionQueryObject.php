<?php

namespace GraphQL\SchemaObject;

class DesignAtVersionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignAtVersionConnection";

    public function selectEdges(DesignAtVersionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DesignAtVersionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DesignAtVersionConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DesignAtVersionQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DesignAtVersionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
