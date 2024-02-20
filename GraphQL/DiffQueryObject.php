<?php

namespace GraphQL\SchemaObject;

class DiffQueryObject extends QueryObject
{
    const OBJECT_NAME = "Diff";

    public function selectAMode()
    {
        $this->selectField("aMode");

        return $this;
    }

    public function selectBMode()
    {
        $this->selectField("bMode");

        return $this;
    }

    public function selectDeletedFile()
    {
        $this->selectField("deletedFile");

        return $this;
    }

    public function selectDiff()
    {
        $this->selectField("diff");

        return $this;
    }

    public function selectNewFile()
    {
        $this->selectField("newFile");

        return $this;
    }

    public function selectNewPath()
    {
        $this->selectField("newPath");

        return $this;
    }

    public function selectOldPath()
    {
        $this->selectField("oldPath");

        return $this;
    }

    public function selectRenamedFile()
    {
        $this->selectField("renamedFile");

        return $this;
    }
}
