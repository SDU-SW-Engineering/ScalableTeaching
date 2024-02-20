<?php

namespace GraphQL\SchemaObject;

class BranchProtectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "BranchProtection";

    public function selectAllowForcePush()
    {
        $this->selectField("allowForcePush");

        return $this;
    }

    public function selectMergeAccessLevels(BranchProtectionMergeAccessLevelsArgumentsObject $argsObject = null)
    {
        $object = new MergeAccessLevelConnectionQueryObject("mergeAccessLevels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPushAccessLevels(BranchProtectionPushAccessLevelsArgumentsObject $argsObject = null)
    {
        $object = new PushAccessLevelConnectionQueryObject("pushAccessLevels");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
