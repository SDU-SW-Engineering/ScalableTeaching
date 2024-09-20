<?php

namespace GraphQL\SchemaObject;

class LabelQueryObject extends QueryObject
{
    const OBJECT_NAME = "Label";

    public function selectColor()
    {
        $this->selectField("color");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDescriptionHtml()
    {
        $this->selectField("descriptionHtml");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLockOnMerge()
    {
        $this->selectField("lockOnMerge");

        return $this;
    }

    public function selectTextColor()
    {
        $this->selectField("textColor");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
