<?php

namespace GraphQL\SchemaObject;

class JiraImportEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "JiraImportEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(JiraImportEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new JiraImportQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
