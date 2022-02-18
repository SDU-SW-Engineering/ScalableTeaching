<?php

namespace GraphQL\SchemaObject;

class NamespaceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NamespaceConnection";

    public function selectEdges(NamespaceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NamespaceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(NamespaceConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NamespaceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
