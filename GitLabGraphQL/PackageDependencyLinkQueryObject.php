<?php

namespace GraphQL\SchemaObject;

class PackageDependencyLinkQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageDependencyLink";

    public function selectDependency(PackageDependencyLinkDependencyArgumentsObject $argsObject = null)
    {
        $object = new PackageDependencyQueryObject("dependency");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDependencyType()
    {
        $this->selectField("dependencyType");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectMetadata(PackageDependencyLinkMetadataArgumentsObject $argsObject = null)
    {
        $object = new DependencyLinkMetadataUnionObject("metadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
