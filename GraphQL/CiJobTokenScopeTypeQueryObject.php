<?php

namespace GraphQL\SchemaObject;

class CiJobTokenScopeTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiJobTokenScopeType";

    public function selectGroupsAllowlist(CiJobTokenScopeTypeGroupsAllowlistArgumentsObject $argsObject = null)
    {
        $object = new GroupConnectionQueryObject("groupsAllowlist");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectInboundAllowlist(CiJobTokenScopeTypeInboundAllowlistArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("inboundAllowlist");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOutboundAllowlist(CiJobTokenScopeTypeOutboundAllowlistArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("outboundAllowlist");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated The `projects` attribute is being deprecated. Use `outbound_allowlist`. Deprecated in 15.9.
     */
    public function selectProjects(CiJobTokenScopeTypeProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
