<?php

namespace GraphQL\SchemaObject;

class DetailedStatusQueryObject extends QueryObject
{
    const OBJECT_NAME = "DetailedStatus";

    public function selectAction(DetailedStatusActionArgumentsObject $argsObject = null)
    {
        $object = new StatusActionQueryObject("action");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDetailsPath()
    {
        $this->selectField("detailsPath");

        return $this;
    }

    public function selectFavicon()
    {
        $this->selectField("favicon");

        return $this;
    }

    public function selectGroup()
    {
        $this->selectField("group");

        return $this;
    }

    public function selectHasDetails()
    {
        $this->selectField("hasDetails");

        return $this;
    }

    public function selectIcon()
    {
        $this->selectField("icon");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }

    public function selectTooltip()
    {
        $this->selectField("tooltip");

        return $this;
    }
}
