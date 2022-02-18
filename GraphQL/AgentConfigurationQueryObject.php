<?php

namespace GraphQL\SchemaObject;

class AgentConfigurationQueryObject extends QueryObject
{
    const OBJECT_NAME = "AgentConfiguration";

    public function selectAgentName()
    {
        $this->selectField("agentName");

        return $this;
    }
}
