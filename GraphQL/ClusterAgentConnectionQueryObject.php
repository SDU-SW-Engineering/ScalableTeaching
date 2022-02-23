<?php

namespace GraphQL\SchemaObject;

class ClusterAgentConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(ClusterAgentConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ClusterAgentConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ClusterAgentConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
