<?php

namespace GraphQL\SchemaObject;

class ClusterAgentAuthorizationUserAccessConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentAuthorizationUserAccessConnection";

    public function selectEdges(ClusterAgentAuthorizationUserAccessConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentAuthorizationUserAccessEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ClusterAgentAuthorizationUserAccessConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentAuthorizationUserAccessQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ClusterAgentAuthorizationUserAccessConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
