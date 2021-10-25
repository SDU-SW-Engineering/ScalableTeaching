<?php

namespace GraphQL\SchemaObject;

class DesignConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignConnection";

    public function selectEdges(DesignConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DesignEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DesignConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DesignQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DesignConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
