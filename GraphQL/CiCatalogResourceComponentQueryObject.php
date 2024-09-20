<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceComponentQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceComponent";

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectIncludePath()
    {
        $this->selectField("includePath");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectInputs(CiCatalogResourceComponentInputsArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceComponentInputQueryObject("inputs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
