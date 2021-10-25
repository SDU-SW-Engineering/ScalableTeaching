<?php

namespace GraphQL\SchemaObject;

class RepositoryBlobQueryObject extends QueryObject
{
    const OBJECT_NAME = "RepositoryBlob";

    public function selectCanModifyBlob()
    {
        $this->selectField("canModifyBlob");

        return $this;
    }

    public function selectEditBlobPath()
    {
        $this->selectField("editBlobPath");

        return $this;
    }

    public function selectExternalStorageUrl()
    {
        $this->selectField("externalStorageUrl");

        return $this;
    }

    public function selectFileType()
    {
        $this->selectField("fileType");

        return $this;
    }

    public function selectForkAndEditPath()
    {
        $this->selectField("forkAndEditPath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIdeEditPath()
    {
        $this->selectField("ideEditPath");

        return $this;
    }

    public function selectIdeForkAndEditPath()
    {
        $this->selectField("ideForkAndEditPath");

        return $this;
    }

    public function selectLfsOid()
    {
        $this->selectField("lfsOid");

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

    public function selectOid()
    {
        $this->selectField("oid");

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

    public function selectRawBlob()
    {
        $this->selectField("rawBlob");

        return $this;
    }

    public function selectRawPath()
    {
        $this->selectField("rawPath");

        return $this;
    }

    public function selectRawSize()
    {
        $this->selectField("rawSize");

        return $this;
    }

    public function selectRawTextBlob()
    {
        $this->selectField("rawTextBlob");

        return $this;
    }

    public function selectReplacePath()
    {
        $this->selectField("replacePath");

        return $this;
    }

    public function selectRichViewer(RepositoryBlobRichViewerArgumentsObject $argsObject = null)
    {
        $object = new BlobViewerQueryObject("richViewer");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSimpleViewer(RepositoryBlobSimpleViewerArgumentsObject $argsObject = null)
    {
        $object = new BlobViewerQueryObject("simpleViewer");
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

    public function selectStoredExternally()
    {
        $this->selectField("storedExternally");

        return $this;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }
}
