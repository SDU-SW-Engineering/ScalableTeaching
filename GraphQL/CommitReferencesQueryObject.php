<?php

namespace GraphQL\SchemaObject;

class CommitReferencesQueryObject extends QueryObject
{
    const OBJECT_NAME = "CommitReferences";

    public function selectContainingBranches(CommitReferencesContainingBranchesArgumentsObject $argsObject = null)
    {
        $object = new CommitParentNamesQueryObject("containingBranches");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainingTags(CommitReferencesContainingTagsArgumentsObject $argsObject = null)
    {
        $object = new CommitParentNamesQueryObject("containingTags");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTippingBranches(CommitReferencesTippingBranchesArgumentsObject $argsObject = null)
    {
        $object = new CommitParentNamesQueryObject("tippingBranches");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTippingTags(CommitReferencesTippingTagsArgumentsObject $argsObject = null)
    {
        $object = new CommitParentNamesQueryObject("tippingTags");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
