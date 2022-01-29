<?php

namespace Domain\GitLab\Definitions;

class Project
{
    private int $id;
    private string $name;
    private string $description;
    private string $webUrl;
    private ?string $avatarUrl;
    private string $gitSshUrl;
    private string $gitHttpUrl;
    private string $namespace;
    private VisibilityLevel $visibilityLevel;
    private string $pathWithNamespace;
    private string $defaultBranch;
    private string $ciConfigPath;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getWebUrl() : string
    {
        return $this->webUrl;
    }

    /**
     * @param string $webUrl
     */
    public function setWebUrl(string $webUrl) : void
    {
        $this->webUrl = $webUrl;
    }

    /**
     * @return string|null
     */
    public function getAvatarUrl() : ?string
    {
        return $this->avatarUrl;
    }

    /**
     * @param string|null $avatarUrl
     */
    public function setAvatarUrl(?string $avatarUrl) : void
    {
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return string
     */
    public function getGitSshUrl() : string
    {
        return $this->gitSshUrl;
    }

    /**
     * @param string $gitSshUrl
     */
    public function setGitSshUrl(string $gitSshUrl) : void
    {
        $this->gitSshUrl = $gitSshUrl;
    }

    /**
     * @return string
     */
    public function getGitHttpUrl() : string
    {
        return $this->gitHttpUrl;
    }

    /**
     * @param string $gitHttpUrl
     */
    public function setGitHttpUrl(string $gitHttpUrl) : void
    {
        $this->gitHttpUrl = $gitHttpUrl;
    }

    /**
     * @return string
     */
    public function getNamespace() : string
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace) : void
    {
        $this->namespace = $namespace;
    }

    /**
     * @return VisibilityLevel
     */
    public function getVisibilityLevel() : VisibilityLevel
    {
        return $this->visibilityLevel;
    }

    /**
     * @param VisibilityLevel $visibilityLevel
     */
    public function setVisibilityLevel(VisibilityLevel $visibilityLevel) : void
    {
        $this->visibilityLevel = $visibilityLevel;
    }

    /**
     * @return string
     */
    public function getPathWithNamespace() : string
    {
        return $this->pathWithNamespace;
    }

    /**
     * @param string $pathWithNamespace
     */
    public function setPathWithNamespace(string $pathWithNamespace) : void
    {
        $this->pathWithNamespace = $pathWithNamespace;
    }

    /**
     * @return string
     */
    public function getDefaultBranch() : string
    {
        return $this->defaultBranch;
    }

    /**
     * @param string $defaultBranch
     */
    public function setDefaultBranch(string $defaultBranch) : void
    {
        $this->defaultBranch = $defaultBranch;
    }

    /**
     * @return string
     */
    public function getCiConfigPath() : string
    {
        return $this->ciConfigPath;
    }

    /**
     * @param string $ciConfigPath
     */
    public function setCiConfigPath(string $ciConfigPath) : void
    {
        $this->ciConfigPath = $ciConfigPath;
    }
}
