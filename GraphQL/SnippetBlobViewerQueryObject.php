<?php

namespace GraphQL\SchemaObject;

class SnippetBlobViewerQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetBlobViewer";

    public function selectCollapsed()
    {
        $this->selectField("collapsed");

        return $this;
    }

    public function selectFileType()
    {
        $this->selectField("fileType");

        return $this;
    }

    public function selectLoadAsync()
    {
        $this->selectField("loadAsync");

        return $this;
    }

    public function selectLoadingPartialName()
    {
        $this->selectField("loadingPartialName");

        return $this;
    }

    public function selectRenderError()
    {
        $this->selectField("renderError");

        return $this;
    }

    public function selectTooLarge()
    {
        $this->selectField("tooLarge");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }
}
