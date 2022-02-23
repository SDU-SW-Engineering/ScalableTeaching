<?php

namespace GraphQL\SchemaObject;

class AgentConfigurationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AgentConfigurationConnection";

    public function selectEdges(AgentConfigurationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AgentConfigurationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(AgentConfigurationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new AgentConfigurationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AgentConfigurationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
