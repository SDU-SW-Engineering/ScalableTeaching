<?php

namespace GraphQL\SchemaObject;

class ClusterAgentAuthorizationCiAccessConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentAuthorizationCiAccessConnection";

    public function selectEdges(ClusterAgentAuthorizationCiAccessConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentAuthorizationCiAccessEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ClusterAgentAuthorizationCiAccessConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentAuthorizationCiAccessQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ClusterAgentAuthorizationCiAccessConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
