<?php

namespace GraphQL\SchemaObject;

class SnippetPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetPermissions";

    public function selectAdminSnippet()
    {
        $this->selectField("adminSnippet");

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

    public function selectReadSnippet()
    {
        $this->selectField("readSnippet");

        return $this;
    }

    public function selectReportSnippet()
    {
        $this->selectField("reportSnippet");

        return $this;
    }

    public function selectUpdateSnippet()
    {
        $this->selectField("updateSnippet");

        return $this;
    }
}
