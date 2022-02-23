<?php

namespace GraphQL\SchemaObject;

class PackageMetadataUnionObject extends UnionObject
{
    public function onComposerMetadata()
    {
        $object = new ComposerMetadataQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onConanMetadata()
    {
        $object = new ConanMetadataQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onMavenMetadata()
    {
        $object = new MavenMetadataQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onNugetMetadata()
    {
        $object = new NugetMetadataQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onPypiMetadata()
    {
        $object = new PypiMetadataQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
