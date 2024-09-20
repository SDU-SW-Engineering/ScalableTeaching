<?php

namespace GraphQL\SchemaObject;

class ProjectDataTransferQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectDataTransfer";

    public function selectEgressNodes(ProjectDataTransferEgressNodesArgumentsObject $argsObject = null)
    {
        $object = new EgressNodeConnectionQueryObject("egressNodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalEgress()
    {
        $this->selectField("totalEgress");

        return $this;
    }
}
