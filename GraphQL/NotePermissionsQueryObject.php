<?php

namespace GraphQL\SchemaObject;

class NotePermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "NotePermissions";

    public function selectAdminNote()
    {
        $this->selectField("adminNote");

        return $this;
    }

    public function selectAwardEmoji()
    {
        $this->selectField("awardEmoji");

        return $this;
    }

    public function selectCreateNote()
    {
        $this->selectField("createNote");

        return $this;
    }

    public function selectReadNote()
    {
        $this->selectField("readNote");

        return $this;
    }

    public function selectRepositionNote()
    {
        $this->selectField("repositionNote");

        return $this;
    }

    public function selectResolveNote()
    {
        $this->selectField("resolveNote");

        return $this;
    }
}
