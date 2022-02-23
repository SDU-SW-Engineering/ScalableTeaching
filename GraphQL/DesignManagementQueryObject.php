<?php

namespace GraphQL\SchemaObject;

class DesignManagementQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignManagement";

    public function selectDesignAtVersion(DesignManagementDesignAtVersionArgumentsObject $argsObject = null)
    {
        $object = new DesignAtVersionQueryObject("designAtVersion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersion(DesignManagementVersionArgumentsObject $argsObject = null)
    {
        $object = new DesignVersionQueryObject("version");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
