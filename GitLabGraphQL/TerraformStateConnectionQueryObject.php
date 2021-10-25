<?php

namespace GraphQL\SchemaObject;

class TerraformStateConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TerraformStateConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(TerraformStateConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TerraformStateConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TerraformStateConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
