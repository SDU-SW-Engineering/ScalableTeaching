<?php

namespace GraphQL\SchemaObject;

class SnippetBlobQueryObject extends QueryObject
{
    const OBJECT_NAME = "SnippetBlob";

    public function selectBinary()
    {
        $this->selectField("binary");

        return $this;
    }

    public function selectExternalStorage()
    {
        $this->selectField("externalStorage");

        return $this;
    }

    public function selectMode()
    {
        $this->selectField("mode");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectPlainData()
    {
        $this->selectField("plainData");

        return $this;
    }

    public function selectRawPath()
    {
        $this->selectField("rawPath");

        return $this;
    }

    public function selectRawPlainData()
    {
        $this->selectField("rawPlainData");

        return $this;
    }

    public function selectRenderedAsText()
    {
        $this->selectField("renderedAsText");

        return $this;
    }

    public function selectRichData()
    {
        $this->selectField("richData");

        return $this;
    }

    public function selectRichViewer(SnippetBlobRichViewerArgumentsObject $argsObject = null)
    {
        $object = new SnippetBlobViewerQueryObject("richViewer");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSimpleViewer(SnippetBlobSimpleViewerArgumentsObject $argsObject = null)
    {
        $object = new SnippetBlobViewerQueryObject("simpleViewer");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSize()
    {
        $this->selectField("size");

        return $this;
    }
}
