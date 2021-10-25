<?php

namespace GraphQL\SchemaObject;

class ClusterAgentQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClusterAgent";

    public function selectConnections(ClusterAgentConnectionsArgumentsObject $argsObject = null)
    {
        $object = new ConnectedAgentConnectionQueryObject("connections");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectCreatedByUser(ClusterAgentCreatedByUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("createdByUser");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectProject(ClusterAgentProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTokens(ClusterAgentTokensArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentTokenConnectionQueryObject("tokens");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }
}
