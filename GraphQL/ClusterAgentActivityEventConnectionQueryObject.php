<?php

namespace GraphQL\SchemaObject;

class ClusterAgentActivityEventConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentActivityEventConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(ClusterAgentActivityEventConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentActivityEventEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ClusterAgentActivityEventConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentActivityEventQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ClusterAgentActivityEventConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
