<?php

namespace GraphQL\SchemaObject;

class ApprovalRuleQueryObject extends QueryObject
{
    const OBJECT_NAME = "ApprovalRule";

    public function selectApprovalsRequired()
    {
        $this->selectField("approvalsRequired");

        return $this;
    }

    public function selectApproved()
    {
        $this->selectField("approved");

        return $this;
    }

    public function selectApprovedBy(ApprovalRuleApprovedByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("approvedBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContainsHiddenGroups()
    {
        $this->selectField("containsHiddenGroups");

        return $this;
    }

    public function selectEligibleApprovers(ApprovalRuleEligibleApproversArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("eligibleApprovers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGroups(ApprovalRuleGroupsArgumentsObject $argsObject = null)
    {
        $object = new GroupConnectionQueryObject("groups");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectOverridden()
    {
        $this->selectField("overridden");

        return $this;
    }

    public function selectSection()
    {
        $this->selectField("section");

        return $this;
    }

    public function selectSourceRule(ApprovalRuleSourceRuleArgumentsObject $argsObject = null)
    {
        $object = new ApprovalRuleQueryObject("sourceRule");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectUsers(ApprovalRuleUsersArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("users");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
