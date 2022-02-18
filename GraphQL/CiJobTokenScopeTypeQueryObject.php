<?php

namespace GraphQL\SchemaObject;

class CiJobTokenScopeTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiJobTokenScopeType";

    public function selectProjects(CiJobTokenScopeTypeProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
