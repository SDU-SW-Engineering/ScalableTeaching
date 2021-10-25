<?php

namespace GraphQL\SchemaObject;

class DependencyLinkMetadataUnionObject extends UnionObject
{
    public function onNugetDependencyLinkMetadata()
    {
        $object = new NugetDependencyLinkMetadataQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
