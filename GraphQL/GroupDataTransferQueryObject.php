<?php

namespace GraphQL\SchemaObject;

class GroupDataTransferQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupDataTransfer";

    public function selectEgressNodes(GroupDataTransferEgressNodesArgumentsObject $argsObject = null)
    {
        $object = new EgressNodeConnectionQueryObject("egressNodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
