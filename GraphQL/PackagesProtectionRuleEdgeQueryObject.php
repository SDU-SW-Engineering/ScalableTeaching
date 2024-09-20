<?php

namespace GraphQL\SchemaObject;

class PackagesProtectionRuleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackagesProtectionRuleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PackagesProtectionRuleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PackagesProtectionRuleQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
