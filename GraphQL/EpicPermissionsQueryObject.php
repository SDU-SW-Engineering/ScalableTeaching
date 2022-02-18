<?php

namespace GraphQL\SchemaObject;

class EpicPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicPermissions";

    public function selectAdminEpic()
    {
        $this->selectField("adminEpic");

        return $this;
    }

    public function selectAwardEmoji()
    {
        $this->selectField("awardEmoji");

        return $this;
    }

    public function selectCreateEpic()
    {
        $this->selectField("createEpic");

        return $this;
    }

    public function selectCreateNote()
    {
        $this->selectField("createNote");

        return $this;
    }

    public function selectDestroyEpic()
    {
        $this->selectField("destroyEpic");

        return $this;
    }

    public function selectReadEpic()
    {
        $this->selectField("readEpic");

        return $this;
    }

    public function selectReadEpicIid()
    {
        $this->selectField("readEpicIid");

        return $this;
    }

    public function selectUpdateEpic()
    {
        $this->selectField("updateEpic");

        return $this;
    }
}
