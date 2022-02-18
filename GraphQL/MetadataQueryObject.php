<?php

namespace GraphQL\SchemaObject;

class MetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "Metadata";

    public function selectKas(MetadataKasArgumentsObject $argsObject = null)
    {
        $object = new KasQueryObject("kas");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRevision()
    {
        $this->selectField("revision");

        return $this;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
