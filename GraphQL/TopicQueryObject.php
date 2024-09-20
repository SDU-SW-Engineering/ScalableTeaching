<?php

namespace GraphQL\SchemaObject;

class TopicQueryObject extends QueryObject
{
    const OBJECT_NAME = "Topic";

    public function selectAvatarUrl()
    {
        $this->selectField("avatarUrl");

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

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }
}
