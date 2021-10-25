<?php

namespace GraphQL\SchemaObject;

class ConnectedAgentConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ConnectedAgentConnection";

    public function selectEdges(ConnectedAgentConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ConnectedAgentEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ConnectedAgentConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ConnectedAgentQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ConnectedAgentConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
