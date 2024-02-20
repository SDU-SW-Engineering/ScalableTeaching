<?php

namespace GraphQL\SchemaObject;

class MlModelVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlModelVersion";

    public function selectLinks(MlModelVersionLinksArgumentsObject $argsObject = null)
    {
        $object = new MLModelVersionLinksQueryObject("_links");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
