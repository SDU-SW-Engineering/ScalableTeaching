<?php

namespace GraphQL\SchemaObject;

class JobNeedUnionUnionObject extends UnionObject
{
    public function onCiBuildNeed()
    {
        $object = new CiBuildNeedQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onCiJob()
    {
        $object = new CiJobQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
