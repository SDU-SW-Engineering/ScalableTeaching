<?php

namespace GraphQL\SchemaObject;

class UserStatusQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserStatus";

    public function selectAvailability()
    {
        $this->selectField("availability");

        return $this;
    }

    public function selectEmoji()
    {
        $this->selectField("emoji");

        return $this;
    }

    public function selectMessage()
    {
        $this->selectField("message");

        return $this;
    }

    public function selectMessageHtml()
    {
        $this->selectField("messageHtml");

        return $this;
    }
}
