<?php

namespace GraphQL\SchemaObject;

class SystemNoteMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "SystemNoteMetadata";

    public function selectAction()
    {
        $this->selectField("action");

        return $this;
    }

    public function selectDescriptionVersion(SystemNoteMetadataDescriptionVersionArgumentsObject $argsObject = null)
    {
        $object = new DescriptionVersionQueryObject("descriptionVersion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}
