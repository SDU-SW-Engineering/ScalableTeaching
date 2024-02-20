<?php

namespace GraphQL\SchemaObject;

class BranchRuleQueryObject extends QueryObject
{
    const OBJECT_NAME = "BranchRule";

    public function selectBranchProtection(BranchRuleBranchProtectionArgumentsObject $argsObject = null)
    {
        $object = new BranchProtectionQueryObject("branchProtection");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIsDefault()
    {
        $this->selectField("isDefault");

        return $this;
    }

    public function selectIsProtected()
    {
        $this->selectField("isProtected");

        return $this;
    }

    public function selectMatchingBranchesCount()
    {
        $this->selectField("matchingBranchesCount");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
