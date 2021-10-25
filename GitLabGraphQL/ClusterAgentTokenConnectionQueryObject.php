<?php

namespace GraphQL\SchemaObject;

class ClusterAgentTokenConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgentTokenConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(ClusterAgentTokenConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentTokenEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ClusterAgentTokenConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentTokenQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ClusterAgentTokenConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
