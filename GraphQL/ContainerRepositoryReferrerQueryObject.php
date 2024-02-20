<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryReferrerQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryReferrer";

    public function selectArtifactType()
    {
        $this->selectField("artifactType");

        return $this;
    }

    public function selectDigest()
    {
        $this->selectField("digest");

        return $this;
    }

    public function selectUserPermissions(ContainerRepositoryReferrerUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryTagPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
