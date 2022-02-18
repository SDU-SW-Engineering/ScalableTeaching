<?php

namespace GraphQL\SchemaObject;

class TreeQueryObject extends QueryObject
{
    const OBJECT_NAME = "Tree";

    public function selectBlobs(TreeBlobsArgumentsObject $argsObject = null)
    {
        $object = new BlobConnectionQueryObject("blobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLastCommit(TreeLastCommitArgumentsObject $argsObject = null)
    {
        $object = new CommitQueryObject("lastCommit");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubmodules(TreeSubmodulesArgumentsObject $argsObject = null)
    {
        $object = new SubmoduleConnectionQueryObject("submodules");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrees(TreeTreesArgumentsObject $argsObject = null)
    {
        $object = new TreeEntryConnectionQueryObject("trees");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
