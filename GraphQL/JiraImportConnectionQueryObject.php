<?php

namespace GraphQL\SchemaObject;

class JiraImportConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "JiraImportConnection";

    public function selectEdges(JiraImportConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new JiraImportEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(JiraImportConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new JiraImportQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(JiraImportConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
