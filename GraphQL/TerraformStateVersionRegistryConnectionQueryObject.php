<?php

namespace GraphQL\SchemaObject;

class TerraformStateVersionRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TerraformStateVersionRegistryConnection";

    public function selectEdges(TerraformStateVersionRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateVersionRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TerraformStateVersionRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateVersionRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TerraformStateVersionRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
