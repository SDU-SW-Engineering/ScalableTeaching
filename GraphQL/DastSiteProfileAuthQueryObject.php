<?php

namespace GraphQL\SchemaObject;

class DastSiteProfileAuthQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastSiteProfileAuth";

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectPassword()
    {
        $this->selectField("password");

        return $this;
    }

    public function selectPasswordField()
    {
        $this->selectField("passwordField");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }

    public function selectUsername()
    {
        $this->selectField("username");

        return $this;
    }

    public function selectUsernameField()
    {
        $this->selectField("usernameField");

        return $this;
    }
}
