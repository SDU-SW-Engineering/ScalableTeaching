<?php

namespace GraphQL\SchemaObject;

class AccessLevelUserQueryObject extends QueryObject
{
    const OBJECT_NAME = "AccessLevelUser";

    public function selectAvatarUrl()
    {
        $this->selectField("avatarUrl");

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

    public function selectPublicEmail()
    {
        $this->selectField("publicEmail");

        return $this;
    }

    public function selectUsername()
    {
        $this->selectField("username");

        return $this;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
