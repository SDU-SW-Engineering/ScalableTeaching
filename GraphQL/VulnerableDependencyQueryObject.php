<?php

namespace GraphQL\SchemaObject;

class VulnerableDependencyQueryObject extends QueryObject
{
    const OBJECT_NAME = "VulnerableDependency";

    public function selectPackage(VulnerableDependencyPackageArgumentsObject $argsObject = null)
    {
        $object = new VulnerablePackageQueryObject("package");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
