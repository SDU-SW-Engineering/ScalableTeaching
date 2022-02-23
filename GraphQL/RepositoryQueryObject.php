<?php

namespace GraphQL\SchemaObject;

class RepositoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "Repository";

    public function selectBlobs(RepositoryBlobsArgumentsObject $argsObject = null)
    {
        $object = new RepositoryBlobConnectionQueryObject("blobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBranchNames()
    {
        $this->selectField("branchNames");

        return $this;
    }

    public function selectDiskPath()
    {
        $this->selectField("diskPath");

        return $this;
    }

    public function selectEmpty()
    {
        $this->selectField("empty");

        return $this;
    }

    public function selectExists()
    {
        $this->selectField("exists");

        return $this;
    }

    public function selectPaginatedTree(RepositoryPaginatedTreeArgumentsObject $argsObject = null)
    {
        $object = new TreeConnectionQueryObject("paginatedTree");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRootRef()
    {
        $this->selectField("rootRef");

        return $this;
    }

    public function selectTree(RepositoryTreeArgumentsObject $argsObject = null)
    {
        $object = new TreeQueryObject("tree");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
