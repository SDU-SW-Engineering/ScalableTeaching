<?php

namespace Domain\GitLab\Definitions;

class Repository
{
    private string $name;

    private string $url;

    private string $description;

    private string $homepage;

    private string $gitHttpUrl;

    private string $gitSshUrl;

    private VisibilityLevel $visibilityLevel;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param  string  $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string  $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * @param  string  $homepage
     */
    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    /**
     * @return string
     */
    public function getGitHttpUrl(): string
    {
        return $this->gitHttpUrl;
    }

    /**
     * @param  string  $gitHttpUrl
     */
    public function setGitHttpUrl(string $gitHttpUrl): void
    {
        $this->gitHttpUrl = $gitHttpUrl;
    }

    /**
     * @return string
     */
    public function getGitSshUrl(): string
    {
        return $this->gitSshUrl;
    }

    /**
     * @param  string  $gitSshUrl
     */
    public function setGitSshUrl(string $gitSshUrl): void
    {
        $this->gitSshUrl = $gitSshUrl;
    }

    /**
     * @return VisibilityLevel
     */
    public function getVisibilityLevel(): VisibilityLevel
    {
        return $this->visibilityLevel;
    }

    /**
     * @param  VisibilityLevel  $visibilityLevel
     */
    public function setVisibilityLevel(VisibilityLevel $visibilityLevel): void
    {
        $this->visibilityLevel = $visibilityLevel;
    }
}
