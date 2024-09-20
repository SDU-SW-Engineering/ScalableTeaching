<?php

namespace GraphQL\SchemaObject;

class IdeQueryObject extends QueryObject
{
    const OBJECT_NAME = "Ide";

    public function selectCodeSuggestionsEnabled()
    {
        $this->selectField("codeSuggestionsEnabled");

        return $this;
    }
}
