<?php

namespace GraphQL\SchemaObject;

class ConnectedAgentQueryObject extends QueryObject
{
    const OBJECT_NAME = "ConnectedAgent";

    public function selectConnectedAt()
    {
        $this->selectField("connectedAt");

        return $this;
    }

    public function selectConnectionId()
    {
        $this->selectField("connectionId");

        return $this;
    }

    public function selectMetadata(ConnectedAgentMetadataArgumentsObject $argsObject = null)
    {
        $object = new AgentMetadataQueryObject("metadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
