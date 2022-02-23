<?php

namespace GraphQL\SchemaObject;

class NetworkPolicyConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NetworkPolicyConnection";

    public function selectEdges(NetworkPolicyConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NetworkPolicyEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(NetworkPolicyConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new NetworkPolicyQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NetworkPolicyConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
