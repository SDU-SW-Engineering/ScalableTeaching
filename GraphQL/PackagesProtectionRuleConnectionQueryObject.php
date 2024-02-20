<?php

namespace GraphQL\SchemaObject;

class PackagesProtectionRuleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackagesProtectionRuleConnection";

    public function selectEdges(PackagesProtectionRuleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PackagesProtectionRuleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PackagesProtectionRuleConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PackagesProtectionRuleQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PackagesProtectionRuleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
