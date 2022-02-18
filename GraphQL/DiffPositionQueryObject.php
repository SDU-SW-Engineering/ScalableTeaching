<?php

namespace GraphQL\SchemaObject;

class DiffPositionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DiffPosition";

    public function selectDiffRefs(DiffPositionDiffRefsArgumentsObject $argsObject = null)
    {
        $object = new DiffRefsQueryObject("diffRefs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFilePath()
    {
        $this->selectField("filePath");

        return $this;
    }

    public function selectHeight()
    {
        $this->selectField("height");

        return $this;
    }

    public function selectNewLine()
    {
        $this->selectField("newLine");

        return $this;
    }

    public function selectNewPath()
    {
        $this->selectField("newPath");

        return $this;
    }

    public function selectOldLine()
    {
        $this->selectField("oldLine");

        return $this;
    }

    public function selectOldPath()
    {
        $this->selectField("oldPath");

        return $this;
    }

    public function selectPositionType()
    {
        $this->selectField("positionType");

        return $this;
    }

    public function selectWidth()
    {
        $this->selectField("width");

        return $this;
    }

    public function selectX()
    {
        $this->selectField("x");

        return $this;
    }

    public function selectY()
    {
        $this->selectField("y");

        return $this;
    }
}
